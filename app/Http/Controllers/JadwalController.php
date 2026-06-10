<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\WhatsAppService;
use App\Models\Notifikasi;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        $jadwal = Jadwal::with(['guru', 'kelas', 'mapel'])
                    ->when($search, function($q) use ($search) {
                        $q->whereHas('mapel', function($q) use ($search) {
                              $q->where('nama_mapel', 'like', "%{$search}%");
                          })
                          ->orWhere('tanggal', 'like', "%{$search}%");
                    })
                    ->orderBy('tanggal', 'desc')
                    ->orderBy('jam_mulai', 'asc')
                    ->paginate(10);

        return view('jadwal', [
            'jadwal' => $jadwal,

            'guru' => Guru::orderBy('nama_guru')->get(),

            'kelas' => Kelas::orderBy('nama_kelas')->get(),

            'mapel' => MataPelajaran::orderBy('nama_mapel')->get(),

            'siswa' => Siswa::orderBy('nama_siswa')->get(),

            'editJadwal' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_guru' => 'required',
            'id_kelas' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'siswa_id' => 'required|array',
        ], [
            'id_guru.required' => 'Guru wajib dipilih.',
            'id_kelas.required' => 'Kelas wajib dipilih.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_selesai.required' => 'Jam selesai wajib diisi.',
            'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai.',
            'siswa_id.required' => 'Siswa wajib dipilih.',
        ]);

        // ====================================================
        // [CORE-LOGIC] VALIDASI BENTROK JADWAL GURU
        // Mengecek apakah guru memiliki jadwal pada tanggal dan jam yang beririsan
        // ====================================================
        $bentrokGuru = Jadwal::where('id_guru', $request->id_guru)
            ->where('tanggal', $request->tanggal)
            ->where(function($q) use ($request) {
                $q->where('jam_mulai', '<', $request->jam_selesai)
                  ->where('jam_selesai', '>', $request->jam_mulai);
            })->first();

        if ($bentrokGuru) {
            return redirect()->back()->withInput()->with('error', 'Gagal: Guru yang dipilih sudah memiliki jadwal mengajar pada waktu tersebut.');
        }

        // ====================================================
        // [CORE-LOGIC] VALIDASI BENTROK JADWAL SISWA
        // Mengecek apakah ada siswa yang jadwalnya beririsan
        // ====================================================
        $jadwalBentrokIds = Jadwal::where('tanggal', $request->tanggal)
            ->where(function($q) use ($request) {
                $q->where('jam_mulai', '<', $request->jam_selesai)
                  ->where('jam_selesai', '>', $request->jam_mulai);
            })->pluck('id_jadwal');

        if ($jadwalBentrokIds->isNotEmpty()) {
            $siswaBentrok = DB::table('jadwal_siswa')
                ->whereIn('jadwal_id', $jadwalBentrokIds)
                ->whereIn('siswa_id', $request->siswa_id)
                ->first();

            if ($siswaBentrok) {
                return redirect()->back()->withInput()->with('error', 'Gagal: Terdapat siswa yang sudah memiliki jadwal lain pada waktu tersebut.');
            }
        }

        DB::beginTransaction();

        try {

            $guru = Guru::findOrFail($request->id_guru);

            $jadwal = Jadwal::create([
                'id_guru' => $request->id_guru,
                'id_kelas' => $request->id_kelas,
                'id_mapel' => $guru->id_mapel,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]);

            foreach ($request->siswa_id as $sid) {

                DB::table('jadwal_siswa')->insert([
                    'jadwal_id' => $jadwal->id_jadwal,
                    'siswa_id' => $sid,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            // AMBIL DATA TAMBAHAN UNTUK PESAN WA
            $guruLengkap = Guru::with('mapel')->findOrFail($request->id_guru);
            $kelasLengkap = Kelas::findOrFail($request->id_kelas);
            $tanggalIndo = Carbon::parse($request->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY');
            
            $wa = new WhatsAppService();

            // 1. KIRIM NOTIFIKASI KE GURU
            if (!empty($guruLengkap->no_telepon)) {
                $pesanGuru = "📅 *Jadwal Mengajar Baru*\n\n" .
                    "Halo Bapak/Ibu *{$guruLengkap->nama_guru}*,\n" .
                    "Anda memiliki jadwal mengajar baru di Bimbel Mentari:\n\n" .
                    "Mata Pelajaran: *" . ($guruLengkap->mapel->nama_mapel ?? '-') . "*\n" .
                    "Kelas: *{$kelasLengkap->nama_kelas}*\n" .
                    "Tanggal: *{$tanggalIndo}*\n" .
                    "Waktu: *{$request->jam_mulai} - {$request->jam_selesai}*\n\n" .
                    "Mohon persiapkan materi dan hadir tepat waktu. Terima kasih! ✨";

                $terkirimGuru = $wa->sendMessage($guruLengkap->no_telepon, $pesanGuru);

                Notifikasi::create([
                    'pesan' => $pesanGuru,
                    'target_phone' => $guruLengkap->no_telepon,
                    'type' => 'jadwal',
                    'status_kirim' => $terkirimGuru ? 'Terkirim' : 'Gagal',
                    'waktu_kirim' => now()
                ]);
            }

            // 2. KIRIM NOTIFIKASI KE SEMUA SISWA
            $siswas = Siswa::whereIn('id', $request->siswa_id)->get();
            foreach ($siswas as $siswa) {
                if (!empty($siswa->no_whatsapp)) {
                    $pesanSiswa = "📅 *Jadwal Belajar Baru*\n\n" .
                        "Halo *{$siswa->nama_siswa}*,\n" .
                        "Berikut adalah jadwal belajar baru kamu di Bimbel Mentari:\n\n" .
                        "Mata Pelajaran: *" . ($guruLengkap->mapel->nama_mapel ?? '-') . "*\n" .
                        "Guru: *{$guruLengkap->nama_guru}*\n" .
                        "Tanggal: *{$tanggalIndo}*\n" .
                        "Waktu: *{$request->jam_mulai} - {$request->jam_selesai}*\n\n" .
                        "Jangan lupa untuk hadir tepat waktu ya! Semangat belajarnya! ✨";

                    $terkirimSiswa = $wa->sendMessage($siswa->no_whatsapp, $pesanSiswa);

                    Notifikasi::create([
                        'pesan' => $pesanSiswa,
                        'target_phone' => $siswa->no_whatsapp,
                        'type' => 'jadwal',
                        'status_kirim' => $terkirimSiswa ? 'Terkirim' : 'Gagal',
                        'waktu_kirim' => now()
                    ]);
                }
            }

            return redirect()
                ->route('jadwal.index')
                ->with('success', 'Data jadwal berhasil ditambahkan dan notifikasi WA telah dikirim.');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data jadwal gagal ditambahkan.');
        }
    }

    public function edit(Request $request, $id)
    {
        $search = $request->query('search');
        
        $jadwal = Jadwal::with(['guru', 'kelas', 'mapel'])
                    ->when($search, function($q) use ($search) {
                        $q->whereHas('mapel', function($q) use ($search) {
                              $q->where('nama_mapel', 'like', "%{$search}%");
                          })
                          ->orWhere('tanggal', 'like', "%{$search}%");
                    })
                    ->orderBy('tanggal', 'desc')
                    ->orderBy('jam_mulai', 'asc')
                    ->paginate(10);

        return view('jadwal', [
            'jadwal' => $jadwal,

            'guru' => Guru::orderBy('nama_guru')->get(),

            'kelas' => Kelas::orderBy('nama_kelas')->get(),

            'mapel' => MataPelajaran::orderBy('nama_mapel')->get(),

            'siswa' => Siswa::orderBy('nama_siswa')->get(),

            'editJadwal' => Jadwal::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_guru' => 'required',
            'id_kelas' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'siswa_id' => 'required|array',
        ]);

        // ====================================================
        // [CORE-LOGIC] VALIDASI BENTROK JADWAL GURU (SAAT UPDATE)
        // Mengecek kecuali jadwal dirinya sendiri (id_jadwal != $id)
        // ====================================================
        $bentrokGuru = Jadwal::where('id_guru', $request->id_guru)
            ->where('tanggal', $request->tanggal)
            ->where('id_jadwal', '!=', $id)
            ->where(function($q) use ($request) {
                $q->where('jam_mulai', '<', $request->jam_selesai)
                  ->where('jam_selesai', '>', $request->jam_mulai);
            })->first();

        if ($bentrokGuru) {
            return redirect()->back()->withInput()->with('error', 'Gagal: Guru yang dipilih sudah memiliki jadwal mengajar pada waktu tersebut.');
        }

        // ====================================================
        // [CORE-LOGIC] VALIDASI BENTROK JADWAL SISWA (SAAT UPDATE)
        // ====================================================
        $jadwalBentrokIds = Jadwal::where('tanggal', $request->tanggal)
            ->where('id_jadwal', '!=', $id)
            ->where(function($q) use ($request) {
                $q->where('jam_mulai', '<', $request->jam_selesai)
                  ->where('jam_selesai', '>', $request->jam_mulai);
            })->pluck('id_jadwal');

        if ($jadwalBentrokIds->isNotEmpty()) {
            $siswaBentrok = DB::table('jadwal_siswa')
                ->whereIn('jadwal_id', $jadwalBentrokIds)
                ->whereIn('siswa_id', $request->siswa_id)
                ->first();

            if ($siswaBentrok) {
                return redirect()->back()->withInput()->with('error', 'Gagal: Terdapat siswa yang sudah memiliki jadwal lain pada waktu tersebut.');
            }
        }

        DB::beginTransaction();

        try {

            $jadwal = Jadwal::findOrFail($id);

            $guru = Guru::findOrFail($request->id_guru);

            $jadwal->update([
                'id_guru' => $request->id_guru,
                'id_kelas' => $request->id_kelas,
                'id_mapel' => $guru->id_mapel,
                'tanggal' => $request->tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
            ]);

            DB::table('jadwal_siswa')
                ->where('jadwal_id', $jadwal->id_jadwal)
                ->delete();

            foreach ($request->siswa_id as $sid) {

                DB::table('jadwal_siswa')->insert([
                    'jadwal_id' => $jadwal->id_jadwal,
                    'siswa_id' => $sid,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return redirect()
                ->route('jadwal.index')
                ->with('success', 'Data jadwal berhasil diperbarui.');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data jadwal gagal diperbarui.');
        }
    }

    public function destroy($id)
    {
        try {

            DB::table('jadwal_siswa')
                ->where('jadwal_id', $id)
                ->delete();

            $jadwal = Jadwal::findOrFail($id);

            $jadwal->delete();

            return redirect()
                ->route('jadwal.index')
                ->with('success', 'Data jadwal berhasil dihapus.');

        } catch (\Exception $e) {

            return redirect()
                ->route('jadwal.index')
                ->with('error', 'Data jadwal gagal dihapus.');
        }
    }
}