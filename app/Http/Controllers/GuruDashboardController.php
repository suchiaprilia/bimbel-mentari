<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruDashboardController extends Controller
{
    public function index()
    {
        if (!auth()->check()) return redirect('/login');
        if (auth()->user()->level != 'guru') return redirect('/login');

        $guru = Guru::where('id_user', auth()->id())->first();

        $jadwal = Jadwal::with(['kelas', 'mapel'])
            ->where('id_guru', $guru->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        $materi = Materi::where('id_guru', $guru->id)->get();

        $totalJadwal = $jadwal->count();
        $totalMateri = $materi->count();

        $totalSiswa = Siswa::whereHas('kelas.jadwal', function ($q) use ($guru) {
            $q->where('id_guru', $guru->id);
        })->count();

        $totalNilai = Nilai::where('id_guru', $guru->id)->count();

        return view('guru_user.dashboard', compact(
            'guru',
            'jadwal',
            'materi',
            'totalJadwal',
            'totalMateri',
            'totalSiswa',
            'totalNilai'
        ));
    }

    public function jadwal()
    {
        if (!auth()->check()) return redirect('/login');
        if (auth()->user()->level != 'guru') return redirect('/login');

        $guru = Guru::with('jadwal.mapel', 'jadwal.kelas')
            ->where('id_user', auth()->id())
            ->first();

        return view('guru_user.jadwal', compact('guru'));
    }

    public function materi()
    {
        if (!auth()->check()) return redirect('/login');
        if (auth()->user()->level != 'guru') return redirect('/login');

        $guru = Guru::where('id_user', auth()->id())->first();

        $materi = Materi::with(['kelas', 'mapel'])
            ->where('id_guru', $guru->id)
            ->orderBy('tanggal_upload', 'desc')
            ->get();

        $kelas = Kelas::all();

        $mapel = MataPelajaran::all();

        return view('guru_user.materi', compact(
            'guru',
            'materi',
            'kelas',
            'mapel'
        ));
    }

    public function storeMateri(Request $request)
    {
        if (!auth()->check()) return redirect('/login');
        if (auth()->user()->level != 'guru') return redirect('/login');

        $request->validate([
            'judul_materi' => 'required|string|max:150',
            'id_kelas' => 'required',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,jpg,jpeg,png|max:5120',
        ]);

        $guru = Guru::where('id_user', auth()->id())->first();

        $path = $request->file('file_materi')->store('materi', 'public');

        Materi::create([
            'id_guru' => $guru->id,
            'id_kelas' => $request->id_kelas,
            'id_mapel' => $guru->id_mapel,
            'judul_materi' => $request->judul_materi,
            'deskripsi' => $request->deskripsi,
            'file_materi' => $path,
            'tanggal_upload' => now()->toDateString(),
        ]);

        return redirect('/guru/materi')
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function deleteMateri($id)
    {
        if (!auth()->check()) return redirect('/login');
        if (auth()->user()->level != 'guru') return redirect('/login');

        $materi = Materi::findOrFail($id);

        $guru = Guru::where('id_user', auth()->id())->first();

        if ($materi->id_guru != $guru->id) {

            return back()->with(
                'error',
                'Anda tidak boleh menghapus materi ini.'
            );
        }

        if (
            $materi->file_materi &&
            Storage::disk('public')->exists($materi->file_materi)
        ) {

            Storage::disk('public')->delete($materi->file_materi);
        }

        $materi->delete();

        return back()->with(
            'success',
            'Materi berhasil dihapus.'
        );
    }

    public function editMateri($id)
    {
        if (!auth()->check()) return redirect('/login');
        if (auth()->user()->level != 'guru') return redirect('/login');

        $guru = Guru::where('id_user', auth()->id())->first();

        $editMateri = Materi::findOrFail($id);

        if ($editMateri->id_guru != $guru->id) {

            return redirect('/guru/materi')->with(
                'error',
                'Anda tidak boleh mengedit materi ini.'
            );
        }

        $materi = Materi::with(['kelas', 'mapel'])
            ->where('id_guru', $guru->id)
            ->orderBy('tanggal_upload', 'desc')
            ->get();

        $kelas = Kelas::all();

        $mapel = MataPelajaran::all();

        return view('guru_user.materi', compact(
            'guru',
            'materi',
            'editMateri',
            'kelas',
            'mapel'
        ));
    }

    public function updateMateri(Request $request, $id)
    {
        if (!auth()->check()) return redirect('/login');
        if (auth()->user()->level != 'guru') return redirect('/login');

        $request->validate([
            'judul_materi' => 'required|string|max:150',
            'id_kelas' => 'required',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,jpg,jpeg,png|max:5120',
        ]);

        $guru = Guru::where('id_user', auth()->id())->first();

        $materi = Materi::findOrFail($id);

        if ($materi->id_guru != $guru->id) {

            return redirect('/guru/materi')->with(
                'error',
                'Anda tidak boleh mengedit materi ini.'
            );
        }

        $data = [
            'id_kelas' => $request->id_kelas,
            'id_mapel' => $guru->id_mapel,
            'judul_materi' => $request->judul_materi,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('file_materi')) {

            if (
                $materi->file_materi &&
                Storage::disk('public')->exists($materi->file_materi)
            ) {

                Storage::disk('public')->delete($materi->file_materi);
            }

            $data['file_materi'] = $request
                ->file('file_materi')
                ->store('materi', 'public');
        }

        $materi->update($data);

        return redirect('/guru/materi')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function nilai(Request $request)
    {
        if (!auth()->check()) return redirect('/login');
        if (auth()->user()->level != 'guru') return redirect('/login');

        $guru = Guru::where('id_user', auth()->id())->first();

        $jadwal = Jadwal::with(['kelas', 'mapel'])
            ->where('id_guru', $guru->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        $selectedJadwal = null;
        $siswa = collect();
        $riwayatNilai = collect();

        if ($request->filled('jadwal_id')) {
            $selectedJadwal = Jadwal::with(['kelas', 'mapel', 'siswa'])
                ->where('id_guru', $guru->id)
                ->where('id_jadwal', $request->jadwal_id)
                ->first();

            $siswa = $selectedJadwal ? $selectedJadwal->siswa : collect();

            if ($selectedJadwal) {
                $siswaIds = $selectedJadwal->siswa->pluck('id')->toArray();
                $riwayatNilai = Nilai::with(['siswa', 'mapel'])
                    ->where('id_guru', $guru->id)
                    ->where('id_mapel', $selectedJadwal->id_mapel)
                    ->whereIn('id_siswa', $siswaIds)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }

        return view('guru_user.nilai', compact(
            'guru',
            'jadwal',
            'selectedJadwal',
            'siswa',
            'riwayatNilai'
        ));
    }

    public function storeNilai(Request $request)
    {
        if (!auth()->check()) return redirect('/login');
        if (auth()->user()->level != 'guru') return redirect('/login');

        $request->validate([
            'jadwal_id' => 'required|exists:jadwal,id_jadwal',
            'jenis_nilai' => 'required|string|max:100',
            'nilai' => 'required|array',
            'nilai.*' => 'nullable|numeric|min:0|max:100',
            'keterangan' => 'nullable|array',
            'keterangan.*' => 'nullable|string|max:255',
        ]);

        $guru = Guru::where('id_user', auth()->id())->first();

        $jadwal = Jadwal::with('mapel', 'siswa')
            ->where('id_guru', $guru->id)
            ->where('id_jadwal', $request->jadwal_id)
            ->first();

        if (!$jadwal) {
            return back()->with('error', 'Jadwal tidak ditemukan.');
        }

        $siswaIds = $jadwal->siswa->pluck('id')->toArray();
        $stored = 0;

        foreach ($request->nilai as $siswaId => $nilai) {
            if (!in_array($siswaId, $siswaIds)) {
                continue;
            }

            if ($nilai === null || $nilai === '') {
                continue;
            }

            Nilai::create([
                'id_guru' => $guru->id,
                'id_siswa' => $siswaId,
                'id_mapel' => $jadwal->id_mapel,
                'jenis_nilai' => $request->jenis_nilai,
                'nilai' => $nilai,
                'keterangan' => $request->keterangan[$siswaId] ?? null,
            ]);

            $stored++;
        }

        if ($stored === 0) {
            return back()->with('error', 'Silakan isi nilai minimal satu siswa.');
        }

        return back()->with('success', 'Nilai berhasil disimpan.');
    }

    public function destroyNilai($id)
    {
        if (!auth()->check()) return redirect('/login');
        if (auth()->user()->level != 'guru') return redirect('/login');

        $guru = Guru::where('id_user', auth()->id())->first();

        $nilai = Nilai::where('id', $id)
            ->where('id_guru', $guru->id)
            ->firstOrFail();

        $nilai->delete();

        return back()->with('success', 'Data nilai berhasil dihapus.');
    }

    public function downloadTemplateNilai(Request $request)
    {
        if (!auth()->check() || auth()->user()->level != 'guru') return redirect('/login');
        
        $request->validate(['jadwal_id' => 'required|exists:jadwal,id_jadwal']);
        $guru = Guru::where('id_user', auth()->id())->first();
        
        $jadwal = Jadwal::with('kelas', 'mapel', 'siswa')
            ->where('id_guru', $guru->id)
            ->where('id_jadwal', $request->jadwal_id)
            ->firstOrFail();

        $rows = [];
        foreach ($jadwal->siswa as $siswa) {
            $rows[] = [
                'ID Siswa (Jangan Diubah)' => $siswa->id,
                'Nama Siswa' => $siswa->nama_siswa ?? $siswa->nama,
                'Nilai' => '',
                'Keterangan' => ''
            ];
        }

        $namaFile = 'Template_Nilai_' . preg_replace('/[^A-Za-z0-9\-]/', '_', $jadwal->mapel->nama_mapel) . '_' . preg_replace('/[^A-Za-z0-9\-]/', '_', $jadwal->kelas->nama_kelas) . '.xlsx';
        
        return \Spatie\SimpleExcel\SimpleExcelWriter::streamDownload($namaFile)
            ->addRows($rows)
            ->toBrowser();
    }

    public function importNilai(Request $request)
    {
        if (!auth()->check() || auth()->user()->level != 'guru') return redirect('/login');

        $request->validate([
            'jadwal_id' => 'required|exists:jadwal,id_jadwal',
            'jenis_nilai' => 'required|string|max:100',
            'file_excel' => 'required|file|mimes:xlsx,csv'
        ]);

        $guru = Guru::where('id_user', auth()->id())->first();
        
        $jadwal = Jadwal::with('mapel', 'siswa')
            ->where('id_guru', $guru->id)
            ->where('id_jadwal', $request->jadwal_id)
            ->first();

        if (!$jadwal) {
            return back()->with('error', 'Jadwal tidak ditemukan.');
        }

        $siswaIds = $jadwal->siswa->pluck('id')->toArray();
        $stored = 0;

        try {
            $extension = $request->file('file_excel')->getClientOriginalExtension();
            $path = $request->file('file_excel')->getRealPath();
            
            $rows = \Spatie\SimpleExcel\SimpleExcelReader::create($path, $extension)->getRows();

            foreach ($rows as $row) {
                $siswaId = $row['ID Siswa (Jangan Diubah)'] ?? null;
                $nilai = $row['Nilai'] ?? null;
                $keterangan = $row['Keterangan'] ?? null;

                if (!$siswaId || !in_array($siswaId, $siswaIds)) {
                    continue;
                }

                if ($nilai === null || $nilai === '') {
                    continue;
                }

                Nilai::create([
                    'id_guru' => $guru->id,
                    'id_siswa' => $siswaId,
                    'id_mapel' => $jadwal->id_mapel,
                    'jenis_nilai' => $request->jenis_nilai,
                    'nilai' => $nilai,
                    'keterangan' => $keterangan,
                ]);

                $stored++;
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Excel Upload Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal memproses file Excel: ' . $e->getMessage());
        }

        if ($stored === 0) {
            return back()->with('error', 'Tidak ada nilai yang berhasil disimpan. Pastikan Anda mengisi kolom Nilai pada siswa yang valid.');
        }

        return back()->with('success', "$stored Nilai berhasil diunggah dan disimpan.");
    }
}