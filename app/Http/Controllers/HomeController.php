<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Pembayaran;
use App\Models\Kelas;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();

        $jumlahGuru = Guru::count();

        $jumlahJadwal = Jadwal::count();

        $jumlahPembayaran = Pembayaran::count();

        // JADWAL HARI INI
        $jadwalHariIni = Jadwal::with([
            'guru',
            'kelas',
            'mapel'
        ])
        ->whereDate('tanggal', now())
        ->get();

        // PEMBAYARAN PENDING
        $pembayaranPending = Pembayaran::where('status', 'pending')
            ->count();

        // PEMBAYARAN TERBARU
        $pembayaranTerbaru = Pembayaran::with('siswa')
            ->latest()
            ->take(5)
            ->get();

        // GRAFIK SISWA PER KELAS
        $kelasChart = Kelas::withCount('siswa')
            ->get();

        // GRAFIK STATUS PEMBAYARAN BULAN INI
        $currentMonth = date('m');
        $currentYear = date('Y');
        $chartPembayaran = [
            'Lunas' => Pembayaran::whereMonth('tanggal_jatuh_tempo', $currentMonth)->whereYear('tanggal_jatuh_tempo', $currentYear)->where('status', 'Lunas')->count(),
            'Menunggu' => Pembayaran::whereMonth('tanggal_jatuh_tempo', $currentMonth)->whereYear('tanggal_jatuh_tempo', $currentYear)->where('status', 'Menunggu')->count(),
            'Belum' => Pembayaran::whereMonth('tanggal_jatuh_tempo', $currentMonth)->whereYear('tanggal_jatuh_tempo', $currentYear)->where('status', 'Belum')->count(),
        ];

        return view('beranda', compact(
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahJadwal',
            'jumlahPembayaran',
            'jadwalHariIni',
            'pembayaranPending',
            'pembayaranTerbaru',
            'kelasChart',
            'chartPembayaran'
        ));
    }
}