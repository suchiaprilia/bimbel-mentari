<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        return view('materi', [
            'materi' => Materi::with(['guru','kelas','mapel'])
                        ->orderBy('tanggal_upload', 'desc')
                        ->get(),
            'guru' => Guru::orderBy('nama_guru')->get(),
            'kelas' => Kelas::orderBy('nama_kelas')->get(),
            'mapel' => MataPelajaran::orderBy('nama_mapel')->get(),
            'editMateri' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_guru' => 'required',
            'id_kelas' => 'required',
            'judul_materi' => 'required|string|max:150',
            'deskripsi' => 'nullable|string|max:1000',
            'tanggal_upload' => 'required|date',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,jpg,jpeg,png|max:5120',
        ]);

        try {

            $guru = Guru::findOrFail($request->id_guru);

            $data = [
                'id_guru' => $request->id_guru,
                'id_kelas' => $request->id_kelas,
                'id_mapel' => $guru->id_mapel,
                'judul_materi' => $request->judul_materi,
                'deskripsi' => $request->deskripsi,
                'tanggal_upload' => $request->tanggal_upload,
            ];

            if ($request->hasFile('file_materi')) {
                $path = $request->file('file_materi')->store('materi', 'public');
                $data['file_materi'] = $path;
            }

            Materi::create($data);

            return redirect()->route('materi.index')
                ->with('success', 'Data materi berhasil ditambahkan.');

        } catch (\Exception $e) {

            return back()->withInput()
                ->with('error', 'Data materi gagal ditambahkan.');
        }
    }

    public function edit($id)
    {
        return view('materi', [
            'materi' => Materi::with(['guru','kelas','mapel'])
                        ->orderBy('tanggal_upload', 'desc')
                        ->get(),
            'guru' => Guru::orderBy('nama_guru')->get(),
            'kelas' => Kelas::orderBy('nama_kelas')->get(),
            'mapel' => MataPelajaran::orderBy('nama_mapel')->get(),
            'editMateri' => Materi::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_guru' => 'required',
            'id_kelas' => 'required',
            'judul_materi' => 'required|string|max:150',
            'deskripsi' => 'nullable|string|max:1000',
            'tanggal_upload' => 'required|date',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,jpg,jpeg,png|max:5120',
        ]);

        try {

            $materi = Materi::findOrFail($id);

            $guru = Guru::findOrFail($request->id_guru);

            $data = [
                'id_guru' => $request->id_guru,
                'id_kelas' => $request->id_kelas,
                'id_mapel' => $guru->id_mapel,
                'judul_materi' => $request->judul_materi,
                'deskripsi' => $request->deskripsi,
                'tanggal_upload' => $request->tanggal_upload,
            ];

            if ($request->hasFile('file_materi')) {

                if ($materi->file_materi && Storage::disk('public')->exists($materi->file_materi)) {
                    Storage::disk('public')->delete($materi->file_materi);
                }

                $path = $request->file('file_materi')->store('materi', 'public');
                $data['file_materi'] = $path;
            }

            $materi->update($data);

            return redirect()->route('materi.index')
                ->with('success', 'Data materi berhasil diperbarui.');

        } catch (\Exception $e) {

            return back()->withInput()
                ->with('error', 'Data materi gagal diperbarui.');
        }
    }

    public function destroy($id)
    {
        try {

            $materi = Materi::findOrFail($id);

            if ($materi->file_materi && Storage::disk('public')->exists($materi->file_materi)) {
                Storage::disk('public')->delete($materi->file_materi);
            }

            $materi->delete();

            return redirect()->route('materi.index')
                ->with('success', 'Data materi berhasil dihapus.');

        } catch (\Exception $e) {

            return redirect()->route('materi.index')
                ->with('error', 'Data materi gagal dihapus.');
        }
    }

    public function download($id)
    {
        try {

            $materi = Materi::findOrFail($id);

            if (!$materi->file_materi || !Storage::disk('public')->exists($materi->file_materi)) {
                return redirect()->route('materi.index')
                    ->with('error', 'File materi tidak ditemukan.');
            }

            return Storage::disk('public')->download($materi->file_materi);

        } catch (\Exception $e) {

            return redirect()->route('materi.index')
                ->with('error', 'File materi gagal diunduh.');
        }
    }
}