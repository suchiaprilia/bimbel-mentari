<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function index()
    {
        return view('guru', [

            'guru' => Guru::with('mapel')->get(),

            'mapel' => MataPelajaran::all(),

            'editGuru' => null
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guru'   => 'required|string|max:100',
            'id_mapel'    => 'nullable|exists:mata_pelajaran,id_mapel',
            'no_whatsapp' => 'required|string|max:20|unique:user,no_wa',
            'alamat'      => 'nullable|string',
        ], [
            'nama_guru.required'   => 'Nama guru wajib diisi.',
            'no_whatsapp.required' => 'No WhatsApp wajib diisi.',
            'no_whatsapp.unique'   => 'No WhatsApp sudah terdaftar.',
        ]);

        try {

            $user = User::create([
                'no_wa'    => $request->no_whatsapp,
                'password' => Hash::make('12345678'),
                'level'    => 'guru',
            ]);

            Guru::create([
                'id_user'     => $user->id,
                'id_mapel'    => $request->id_mapel ?: null,
                'nama_guru'   => $request->nama_guru,
                'no_whatsapp' => $request->no_whatsapp,
                'alamat'      => $request->alamat,
            ]);

            return redirect()
                ->route('guru.index')
                ->with('success', 'Data guru berhasil ditambahkan. Password default: 12345678');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        return view('guru', [

            'guru' => Guru::with('mapel')->get(),

            'mapel' => MataPelajaran::all(),

            'editGuru' => Guru::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:100',
            'id_mapel' => 'required',
            'no_whatsapp' => 'required|regex:/^[0-9]{10,15}$/',
            'alamat' => 'nullable|string',
        ]);

        try {

            $guru = Guru::findOrFail($id);

            $guru->update([

                'id_mapel' => $request->id_mapel,

                'nama_guru' => $request->nama_guru,

                'no_whatsapp' => $request->no_whatsapp,

                'alamat' => $request->alamat,
            ]);

            if ($guru->id_user) {

                User::where('id', $guru->id_user)->update([
                    'no_wa' => $request->no_whatsapp,
                ]);
            }

            return redirect()
                ->route('guru.index')
                ->with('success', 'Data guru berhasil diperbarui.');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data guru gagal diperbarui.');
        }
    }

    public function destroy($id)
    {
        try {

            $guru = Guru::findOrFail($id);

            if ($guru->id_user) {

                User::where('id', $guru->id_user)->delete();
            }

            $guru->delete();

            return redirect()
                ->route('guru.index')
                ->with('success', 'Data guru berhasil dihapus.');

        } catch (\Exception $e) {

            return redirect()
                ->route('guru.index')
                ->with('error', 'Data guru gagal dihapus.');
        }
    }

    public function createMateri()
    {
        return view('guru_user.create_materi');
    }

    public function storeMateri(Request $request)
    {
        $request->validate([
            'judul_materi' => 'required',
            'id_kelas' => 'required',
            'file_materi' => 'required|file'
        ]);

        $guru = \App\Models\Guru::where('id_user', auth()->id())->first();

        $path = $request->file('file_materi')->store('materi', 'public');

        \App\Models\Materi::create([
            'id_guru' => $guru->id,
            'id_kelas' => $request->id_kelas,
            'judul_materi' => $request->judul_materi,
            'file_materi' => $path,
            'tanggal_upload' => now()
        ]);

        return redirect('/guru/materi')
            ->with('success', 'Materi berhasil upload');
    }

    public function profil()
    {
        if (!Auth::check() || Auth::user()->level != 'guru') {
            return redirect('/login');
        }

        $guru = Guru::where('id_user', Auth::id())->first();

        if (!$guru) {
            return redirect('/login')->with('error', 'Data guru tidak ditemukan.');
        }

        return view('guru_user.profil', compact('guru'));
    }

    public function updateProfil(Request $request)
    {
        if (!Auth::check() || Auth::user()->level != 'guru') {
            return redirect('/login');
        }

        $request->validate([
            'nama_guru' => 'required|string|max:100',
            'no_whatsapp' => 'required',
            'alamat' => 'nullable|string',
        ]);

        $guru = Guru::where('id_user', Auth::id())->first();

        if (!$guru) {
            return redirect('/login')->with('error', 'Data guru tidak ditemukan.');
        }

        $guru->update([
            'nama_guru' => $request->nama_guru,
            'no_whatsapp' => $request->no_whatsapp,
            'alamat' => $request->alamat,
        ]);

        if ($guru->id_user) {

            User::where('id', $guru->id_user)->update([
                'no_wa' => $request->no_whatsapp
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}