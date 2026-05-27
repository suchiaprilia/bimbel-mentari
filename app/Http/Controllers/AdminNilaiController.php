<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class AdminNilaiController extends Controller
{
    /**
     * Tampilkan rekapitulasi nilai untuk admin
     */
    public function index(Request $request)
    {
        if (!auth()->check() || auth()->user()->level != 'admin') {
            return redirect('/login')->with('error', 'Akses ditolak.');
        }

        $query = Nilai::with(['siswa.kelas', 'guru', 'mapel']);

        // Filter by Mapel
        if ($request->filled('id_mapel')) {
            $query->where('id_mapel', $request->id_mapel);
        }

        $nilai = $query->orderBy('created_at', 'desc')->get();
        $mapels = MataPelajaran::all();

        return view('admin_nilai', compact('nilai', 'mapels'));
    }

    /**
     * Update nilai spesifik
     */
    public function update(Request $request, $id)
    {
        if (!auth()->check() || auth()->user()->level != 'admin') {
            return redirect('/login');
        }

        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'jenis_nilai' => 'required|string|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update([
            'nilai' => $request->nilai,
            'jenis_nilai' => $request->jenis_nilai,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Data nilai berhasil diperbarui.');
    }

    /**
     * Hapus record nilai yang salah
     */
    public function destroy($id)
    {
        if (!auth()->check() || auth()->user()->level != 'admin') {
            return redirect('/login');
        }

        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->back()->with('success', 'Data nilai berhasil dihapus.');
    }
}
