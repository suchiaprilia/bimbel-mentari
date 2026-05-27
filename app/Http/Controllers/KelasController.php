<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return view('kelas', [
            'kelas' => Kelas::all(),
            'editKelas' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.string' => 'Nama kelas harus berupa teks.',
            'nama_kelas.max' => 'Nama kelas maksimal 100 karakter.',
        ]);

        try {
            Kelas::create([
                'nama_kelas' => $request->nama_kelas,
            ]);

            return redirect()
                ->route('kelas.index')
                ->with('success', 'Data kelas berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data kelas gagal ditambahkan.');
        }
    }

    public function edit($id)
    {
        return view('kelas', [
            'kelas' => Kelas::all(),
            'editKelas' => Kelas::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:100',
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.string' => 'Nama kelas harus berupa teks.',
            'nama_kelas.max' => 'Nama kelas maksimal 100 karakter.',
        ]);

        try {
            $kelas = Kelas::findOrFail($id);

            $kelas->update([
                'nama_kelas' => $request->nama_kelas,
            ]);

            return redirect()
                ->route('kelas.index')
                ->with('success', 'Data kelas berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data kelas gagal diperbarui.');
        }
    }

    public function destroy($id)
    {
        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->delete();

            return redirect()
                ->route('kelas.index')
                ->with('success', 'Data kelas berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('kelas.index')
                ->with('error', 'Data kelas gagal dihapus.');
        }
    }
}