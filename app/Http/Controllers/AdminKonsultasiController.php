<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use Illuminate\Http\Request;

class AdminKonsultasiController extends Controller
{
    /**
     * Tampilkan seluruh data konsultasi untuk admin
     */
    public function index(Request $request)
    {
        // Pastikan hanya admin yang bisa mengakses
        if (!auth()->check() || auth()->user()->level != 'admin') {
            return redirect('/login')->with('error', 'Akses ditolak.');
        }

        // Ambil semua data konsultasi beserta relasi siswa (dan kelas) serta guru
        $query = Konsultasi::with(['siswa.kelas', 'guru']);

        // Filter sederhana berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $konsultasi = $query->orderBy('created_at', 'desc')->get();

        return view('admin_konsultasi', compact('konsultasi'));
    }

    /**
     * Hapus record konsultasi (opsional jika ada kesalahan/spam)
     */
    public function destroy($id)
    {
        if (!auth()->check() || auth()->user()->level != 'admin') {
            return redirect('/login');
        }

        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->delete();

        return redirect()->back()->with('success', 'Riwayat konsultasi berhasil dihapus.');
    }
}
