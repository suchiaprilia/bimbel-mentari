<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        return view('mapel', [
            'mapel' => MataPelajaran::orderBy('nama_mapel')->get(),
            'editMapel' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:100',
        ], [
            'nama_mapel.required' => 'Nama mata pelajaran wajib diisi.',
        ]);

        try {

            MataPelajaran::create([
                'nama_mapel' => $request->nama_mapel,
            ]);

            return redirect()
                ->route('mapel.index')
                ->with('success', 'Data mata pelajaran berhasil ditambahkan.');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data mata pelajaran gagal ditambahkan.');
        }
    }

    public function edit($id)
    {
        return view('mapel', [
            'mapel' => MataPelajaran::orderBy('nama_mapel')->get(),
            'editMapel' => MataPelajaran::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:100',
        ], [
            'nama_mapel.required' => 'Nama mata pelajaran wajib diisi.',
        ]);

        try {

            $mapel = MataPelajaran::findOrFail($id);

            $mapel->update([
                'nama_mapel' => $request->nama_mapel,
            ]);

            return redirect()
                ->route('mapel.index')
                ->with('success', 'Data mata pelajaran berhasil diperbarui.');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data mata pelajaran gagal diperbarui.');
        }
    }

    public function destroy($id)
    {
        try {

            $mapel = MataPelajaran::findOrFail($id);

            $mapel->delete();

            return redirect()
                ->route('mapel.index')
                ->with('success', 'Data mata pelajaran berhasil dihapus.');

        } catch (\Exception $e) {

            return redirect()
                ->route('mapel.index')
                ->with('error', 'Data mata pelajaran gagal dihapus.');
        }
    }
}