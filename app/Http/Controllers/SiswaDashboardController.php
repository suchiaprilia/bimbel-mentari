<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Materi;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->level != 'siswa') {
            return redirect('/login');
        }

        // DATA SISWA
        $siswa = Siswa::with('kelas')
            ->where('id_user', auth()->id())
            ->first();

        // CEK JIKA DATA SISWA TIDAK ADA
        if (!$siswa) {
            return redirect('/login');
        }

        // JADWAL KHUSUS SISWA INI
        $jadwal = $siswa->jadwal()
            ->with('guru', 'mapel')
            ->get();

        // AMBIL MAPEL DARI JADWAL SISWA
        $jadwalMapel = $siswa->jadwal()
            ->pluck('id_mapel');

        // FILTER MATERI BERDASARKAN JADWAL SISWA
        $materi = collect();
        if ($jadwalMapel->isNotEmpty()) {
            $materi = Materi::with('mapel', 'guru')
                ->where('id_kelas', $siswa->id_kelas)
                ->whereIn('id_mapel', $jadwalMapel)
                ->get();
        }

        $nilaiCount = Nilai::where('id_siswa', $siswa->id)->count();

        return view('siswa_user.dashboard', compact(
            'siswa',
            'jadwal',
            'materi',
            'nilaiCount'
        ));
    }

    public function jadwal()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->level != 'siswa') {
            return redirect('/login');
        }

        // DATA SISWA
        $siswa = Siswa::with('kelas')
            ->where('id_user', auth()->id())
            ->first();

        // CEK JIKA SISWA TIDAK ADA
        if (!$siswa) {
            return redirect('/login');
        }

        // JADWAL KHUSUS SISWA INI
        $jadwal = $siswa->jadwal()
            ->with('mapel', 'guru')
            ->get();

        return view('siswa_user.jadwal', compact(
            'siswa',
            'jadwal'
        ));
    }

    public function materi()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->level != 'siswa') {
            return redirect('/login');
        }

        // DATA SISWA
        $siswa = Siswa::with('kelas')
            ->where('id_user', auth()->id())
            ->first();

        // CEK JIKA SISWA TIDAK ADA
        if (!$siswa) {
            return redirect('/login');
        }

        // MAPEL DARI JADWAL SISWA
        $jadwalMapel = $siswa->jadwal()
            ->pluck('id_mapel');

        // FILTER MATERI
        $materi = collect();
        if ($jadwalMapel->isNotEmpty()) {
            $materi = Materi::with('mapel', 'guru')
                ->where('id_kelas', $siswa->id_kelas)
                ->whereIn('id_mapel', $jadwalMapel)
                ->get();
        }

        $nilaiCount = Nilai::where('id_siswa', $siswa->id)->count();

        return view('siswa_user.materi', compact(
            'siswa',
            'materi',
            'nilaiCount'
        ));
    }

    public function nilai()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->level != 'siswa') {
            return redirect('/login');
        }

        $siswa = Siswa::with('kelas')
            ->where('id_user', auth()->id())
            ->first();

        if (!$siswa) {
            return redirect('/login');
        }

        $nilai = Nilai::with('mapel')
            ->where('id_siswa', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa_user.nilai', compact(
            'siswa',
            'nilai'
        ));
    }

    public function pembayaran()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (auth()->user()->level != 'siswa') {
            return redirect('/login');
        }

        $siswa = Siswa::with('kelas')
            ->where('id_user', auth()->id())
            ->first();

        if (!$siswa) {
            return redirect('/login');
        }

        $pembayaran = \App\Models\Pembayaran::where('id_siswa', $siswa->id)
            ->with('notifikasi')
            ->orderBy('tanggal_jatuh_tempo', 'desc')
            ->get();

        $totalTagihan = $pembayaran->sum('jumlah');
        $belumBayar = $pembayaran->whereIn('status', ['Belum', 'Menunggu'])->sum('jumlah');
        $lunas = $pembayaran->where('status', 'Lunas')->sum('jumlah');

        return view('siswa_user.pembayaran', compact(
            'siswa',
            'pembayaran',
            'totalTagihan',
            'belumBayar',
            'lunas'
        ));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'id_pembayaran' => 'required',
            'metode_pembayaran' => 'required|in:cash,transfer',
            'bukti_transfer' => 'nullable|file|mimes:pdf,jpg,jpeg,png'
        ]);

        $pembayaran = \App\Models\Pembayaran::findOrFail($request->id_pembayaran);

        $bukti = $pembayaran->bukti_transfer;
        $status = 'Belum';

        if ($request->metode_pembayaran === 'cash') {
            $status = 'Belum'; // Admin still needs to verify cash
            $message = "Siswa memberitahukan akan membayar secara tunai.";
        } elseif ($request->hasFile('bukti_transfer')) {
            $status = 'Menunggu';
            $bukti = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            $message = "Siswa mengunggah bukti transfer.";
        } else {
            return redirect()->back()->with('error', 'Bukti transfer wajib diunggah untuk metode transfer.');
        }

        $pembayaran->update([
            'status' => $status,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_transfer' => $bukti
        ]);

        \App\Models\Notifikasi::create([
            'id_pembayaran' => $pembayaran->id,
            'pesan' => $message,
            'waktu_kirim' => now()
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload.');
    }

    public function toggleParent(Request $request)
    {
        $current = session('is_parent_mode', false);
        
        if (!$current) {
            // Validasi PIN jika mau masuk mode orang tua
            $pin = $request->query('pin');
            $siswa = Siswa::where('id_user', auth()->id())->first();
            $wa = $siswa->no_whatsapp ?? '';
            
            // Mengambil 4 digit terakhir
            $correctPin = substr($wa, -4);
            
            // Jika WA kosong atau kurang dari 4 digit, kita pakai default 1234
            if (strlen($wa) < 4) {
                $correctPin = '1234';
            }
            
            if (!$pin || $pin !== $correctPin) {
                return redirect()->back()->with('error', 'Akses ditolak: PIN Orang Tua (4 digit terakhir WA) salah!');
            }
        }

        session(['is_parent_mode' => !$current]);

        if (!$current) {
            return redirect('/siswa/parent-dashboard')->with('success', 'Berpindah ke Mode Orang Tua');
        } else {
            return redirect('/siswa-dashboard')->with('success', 'Berpindah ke Mode Siswa');
        }
    }

    public function parentDashboard()
    {
        if (!auth()->check() || auth()->user()->level != 'siswa') {
            return redirect('/login');
        }

        if (!session('is_parent_mode')) {
            return redirect('/siswa-dashboard');
        }

        $siswa = Siswa::with(['kelas', 'nilai.mapel', 'pembayaran'])
            ->where('id_user', auth()->id())
            ->first();

        if (!$siswa) {
            return redirect('/login');
        }

        // Statistik untuk Orang Tua
        $totalTagihan = $siswa->pembayaran->sum('jumlah');
        $lunas = $siswa->pembayaran->where('status', 'Lunas')->sum('jumlah');
        $tunggakan = $totalTagihan - $lunas;

        $rataNilai = $siswa->nilai->avg('nilai');
        
        $pembayaranTerakhir = $siswa->pembayaran()->orderBy('tanggal_jatuh_tempo', 'desc')->take(5)->get();
        $nilaiTerakhir = $siswa->nilai()->with('mapel')->orderBy('created_at', 'desc')->take(5)->get();

        // Data untuk Grafik Nilai (Ambil 10 nilai terakhir urut dari yang terlama ke terbaru)
        $grafikNilai = $siswa->nilai()->with('mapel')->orderBy('created_at', 'asc')->take(10)->get();
        $chartLabels = $grafikNilai->map(function($n) {
            return $n->mapel->nama_mapel . ' (' . date('d/m', strtotime($n->created_at)) . ')';
        });
        $chartData = $grafikNilai->pluck('nilai');

        // Mapel Terbaik
        $mapelTerbaik = '-';
        if($siswa->nilai->count() > 0) {
            $best = $siswa->nilai->sortByDesc('nilai')->first();
            $mapelTerbaik = $best->mapel->nama_mapel . ' (' . $best->nilai . ')';
        }

        return view('siswa_user.parent_dashboard', compact(
            'siswa',
            'totalTagihan',
            'lunas',
            'tunggakan',
            'rataNilai',
            'pembayaranTerakhir',
            'nilaiTerakhir',
            'chartLabels',
            'chartData',
            'mapelTerbaik'
        ));
    }

    public function exportNilai()
    {
        if (!auth()->check() || auth()->user()->level != 'siswa') {
            return redirect('/login');
        }

        $siswa = Siswa::where('id_user', auth()->id())->first();
        if (!$siswa) return redirect('/login');

        $nilai = Nilai::with('mapel')
            ->where('id_siswa', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $rows = [];
        foreach ($nilai as $n) {
            $rows[] = [
                'Mata Pelajaran' => $n->mapel->nama_mapel ?? '-',
                'Jenis Nilai' => $n->jenis_nilai,
                'Nilai' => $n->nilai,
                'Keterangan' => $n->keterangan ?? '-',
                'Tanggal' => date('d/m/Y', strtotime($n->created_at))
            ];
        }

        return \Spatie\SimpleExcel\SimpleExcelWriter::streamDownload('Rekap_Nilai_' . preg_replace('/[^A-Za-z0-9\-]/', '_', $siswa->nama_siswa ?? $siswa->nama) . '.xlsx')
            ->addRows($rows)
            ->toBrowser();
    }

    public function cetakNilai()
    {
        if (!auth()->check() || auth()->user()->level != 'siswa') {
            return redirect('/login');
        }

        $siswa = Siswa::with('kelas')->where('id_user', auth()->id())->first();
        if (!$siswa) return redirect('/login');

        $nilai = Nilai::with('mapel')
            ->where('id_siswa', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa_user.cetak_nilai', compact('siswa', 'nilai'));
    }
}