<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Konsultasi;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    /**
     * --- BAGIAN ORANG TUA ---
     */

    public function indexSiswa()
    {
        if (!auth()->check() || auth()->user()->level != 'siswa') {
            return redirect('/login');
        }

        // Hanya boleh diakses dalam Parent Mode
        if (!session('is_parent_mode')) {
            return redirect('/siswa-dashboard')->with('error', 'Akses khusus Mode Orang Tua.');
        }

        $siswa = Siswa::with('kelas')->where('id_user', auth()->id())->first();
        if (!$siswa) {
            return redirect('/login');
        }

        // Ambil riwayat konsultasi siswa ini
        $riwayat = Konsultasi::with('guru')
            ->where('id_siswa', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Tandai balasan guru yang belum dibaca sebagai sudah dibaca
        Konsultasi::where('id_siswa', $siswa->id)
            ->where('status', 'Dijawab')
            ->where('is_read_siswa', false)
            ->update(['is_read_siswa' => true]);

        // Ambil daftar guru pengajar dari jadwal untuk pilihan di dropdown
        $jadwal = $siswa->jadwal()->with('guru')->get();
        $daftarGuru = $jadwal->pluck('guru')->unique('id')->filter();

        return view('siswa_user.konsultasi', compact('siswa', 'riwayat', 'daftarGuru'));
    }

    public function storeSiswa(Request $request)
    {
        if (!auth()->check() || auth()->user()->level != 'siswa') {
            return redirect('/login');
        }

        $request->validate([
            'id_guru' => 'required|exists:guru,id',
            'topik' => 'required|string|max:150',
            'pertanyaan' => 'required|string',
        ]);

        $siswa = Siswa::where('id_user', auth()->id())->firstOrFail();

        Konsultasi::create([
            'id_siswa' => $siswa->id,
            'id_guru' => $request->id_guru,
            'topik' => $request->topik,
            'pertanyaan' => $request->pertanyaan,
            'status' => 'Menunggu'
        ]);

        return redirect()->back()->with('success', 'Pertanyaan konsultasi berhasil terkirim ke Guru.');
    }

    /**
     * --- BAGIAN GURU ---
     */

    public function indexGuru()
    {
        if (!auth()->check() || auth()->user()->level != 'guru') {
            return redirect('/login');
        }

        $guru = Guru::where('id_user', auth()->id())->first();
        if (!$guru) {
            return redirect('/login');
        }

        // Ambil semua pertanyaan konsultasi untuk guru ini
        $konsultasi = Konsultasi::with('siswa.kelas')
            ->where('id_guru', $guru->id)
            ->orderBy('status', 'asc') // 'Menunggu' muncul di atas
            ->orderBy('created_at', 'desc')
            ->get();

        return view('guru_user.konsultasi', compact('guru', 'konsultasi'));
    }

    public function updateGuru(Request $request, $id)
    {
        if (!auth()->check() || auth()->user()->level != 'guru') {
            return redirect('/login');
        }

        $request->validate([
            'jawaban' => 'required|string',
        ]);

        $guru = Guru::where('id_user', auth()->id())->firstOrFail();

        $konsultasi = Konsultasi::where('id', $id)
            ->where('id_guru', $guru->id)
            ->firstOrFail();

        $konsultasi->update([
            'jawaban' => $request->jawaban,
            'status' => 'Dijawab',
            'is_read_siswa' => false
        ]);

        return redirect()->back()->with('success', 'Tanggapan konsultasi berhasil dikirim ke Orang Tua.');
    }
}
