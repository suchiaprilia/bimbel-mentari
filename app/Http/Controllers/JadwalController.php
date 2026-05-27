<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index()
    {
        return view('jadwal', [
            'jadwal' => Jadwal::with(['guru', 'kelas', 'mapel'])
                        ->orderBy('tanggal', 'desc')
                        ->orderBy('jam_mulai', 'asc')
                        ->get(),

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

            return redirect()
                ->route('jadwal.index')
                ->with('success', 'Data jadwal berhasil ditambahkan.');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data jadwal gagal ditambahkan.');
        }
    }

    public function edit($id)
    {
        return view('jadwal', [
            'jadwal' => Jadwal::with(['guru', 'kelas', 'mapel'])
                        ->orderBy('tanggal', 'desc')
                        ->orderBy('jam_mulai', 'asc')
                        ->get(),

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