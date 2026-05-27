<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArsipAbsensiController extends Controller
{
    public function indexGuru()
    {
        if (!auth()->check() || auth()->user()->level != 'guru') return redirect('/login');

        $arsip = \App\Models\ArsipAbsensi::orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('guru_user.arsip_absensi', compact('arsip'));
    }

    public function indexAdmin()
    {
        if (!auth()->check() || auth()->user()->level != 'admin') return redirect('/login');

        $arsip = \App\Models\ArsipAbsensi::orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin_arsip_absensi', compact('arsip'));
    }

    public function store(Request $request)
    {
        if (!auth()->check() || !in_array(auth()->user()->level, ['guru', 'admin'])) {
            return redirect('/login');
        }

        $request->validate([
            'judul_arsip' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file_arsip' => 'required|file|mimes:pdf,xls,xlsx,jpg,jpeg,png|max:5120',
        ]);

        $exists = \App\Models\ArsipAbsensi::where('judul_arsip', $request->judul_arsip)
            ->where('tanggal', $request->tanggal)
            ->exists();

        if ($exists) {
            return back()->withErrors(['judul_arsip' => 'Arsip absensi untuk judul dan tanggal ini sudah pernah diunggah.'])->withInput();
        }

        $path = $request->file('file_arsip')->store('arsip_absensi', 'public');

        \App\Models\ArsipAbsensi::create([
            'judul_arsip' => $request->judul_arsip,
            'tanggal' => $request->tanggal,
            'file_path' => $path,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Arsip Absensi berhasil diunggah.');
    }

    public function destroy($id)
    {
        if (!auth()->check() || !in_array(auth()->user()->level, ['guru', 'admin'])) {
            return redirect('/login');
        }

        $arsip = \App\Models\ArsipAbsensi::findOrFail($id);

        if ($arsip->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($arsip->file_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($arsip->file_path);
        }

        $arsip->delete();

        return back()->with('success', 'Arsip Absensi berhasil dihapus.');
    }
}

