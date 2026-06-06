<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // ====================================================
    // [CORE-LOGIC] METHOD INDEX (READ)
    // Mengambil dataset siswa dengan filter search dan pagination.
    // ====================================================
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        $siswa = Siswa::with('kelas')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->select('siswa.*')
            ->when($search, function($q) use ($search) {
                $q->where('siswa.nama_siswa', 'like', "%{$search}%")
                  ->orWhere('siswa.no_whatsapp', 'like', "%{$search}%");
            })
            ->orderBy('kelas.nama_kelas', 'asc')
            ->paginate(10);

        return view('siswa', [
            'siswa' => $siswa,
            'kelas' => Kelas::all(),
            'editSiswa' => null
        ]);
    }

    // ====================================================
    // [CORE-LOGIC] METHOD STORE (CREATE)
    // Validasi request dan proses insert data siswa ke database.
    // Pengaturan password default di-hash pada blok ini.
    // ====================================================
    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|exists:kelas,id',
            'nama_siswa' => 'required|string|max:100',
            'no_whatsapp' => 'required|regex:/^[0-9]{10,15}$/',
            'alamat' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'id_kelas.required' => 'Kelas wajib dipilih.',
            'id_kelas.exists' => 'Kelas tidak valid.',

            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'nama_siswa.string' => 'Nama siswa harus berupa teks.',
            'nama_siswa.max' => 'Nama siswa maksimal 100 karakter.',

            'no_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'no_whatsapp.regex' => 'Nomor WhatsApp harus berupa angka 10 sampai 15 digit.',

            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',

            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ]);

        try {
            Siswa::create([
                'id_kelas' => $request->id_kelas,
                'nama_siswa' => $request->nama_siswa,
                'no_whatsapp' => $request->no_whatsapp,
                'alamat' => $request->alamat,
                'status' => $request->status,
            ]);

            return redirect()
                ->route('siswa.index')
                ->with('success', 'Data siswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data siswa gagal ditambahkan.');
        }
    }

    public function edit(Request $request, $id)
    {
        $search = $request->query('search');
        
        $siswa = Siswa::with('kelas')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->select('siswa.*')
            ->when($search, function($q) use ($search) {
                $q->where('siswa.nama_siswa', 'like', "%{$search}%")
                  ->orWhere('siswa.no_whatsapp', 'like', "%{$search}%");
            })
            ->orderBy('kelas.nama_kelas', 'asc')
            ->paginate(10);

        return view('siswa', [
            'siswa' => $siswa,
            'kelas' => Kelas::all(),
            'editSiswa' => Siswa::findOrFail($id)
        ]);
    }

    // ====================================================
    // [CORE-LOGIC] METHOD UPDATE
    // Memperbarui atribut record siswa berdasarkan request form.
    // ====================================================
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kelas' => 'required|exists:kelas,id',
            'nama_siswa' => 'required|string|max:100',
            'no_whatsapp' => 'required|regex:/^[0-9]{10,15}$/',
            'alamat' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'id_kelas.required' => 'Kelas wajib dipilih.',
            'id_kelas.exists' => 'Kelas tidak valid.',

            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'nama_siswa.string' => 'Nama siswa harus berupa teks.',
            'nama_siswa.max' => 'Nama siswa maksimal 100 karakter.',

            'no_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'no_whatsapp.regex' => 'Nomor WhatsApp harus berupa angka 10 sampai 15 digit.',

            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',

            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ]);

        try {
            $siswa = Siswa::findOrFail($id);

            $siswa->update([
                'id_kelas' => $request->id_kelas,
                'nama_siswa' => $request->nama_siswa,
                'no_whatsapp' => $request->no_whatsapp,
                'alamat' => $request->alamat,
                'status' => $request->status,
            ]);

            return redirect()
                ->route('siswa.index')
                ->with('success', 'Data siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data siswa gagal diperbarui.');
        }
    }

    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();

            return redirect()
                ->route('siswa.index')
                ->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('siswa.index')
                ->with('error', 'Data siswa gagal dihapus.');
        }
    }
    public function profil()
{
    $user = auth()->user();

    $siswa = \App\Models\Siswa::where('id_user', $user->id)->first();

    return view('siswa_user.profil', compact('siswa'));
}

public function updateProfil(Request $request)
{
    $request->validate([
        'nama_siswa' => 'required',
        'alamat' => 'required',
        'no_whatsapp' => 'required',
    ]);

    $user = auth()->user();

    $siswa = \App\Models\Siswa::where('id_user', $user->id)->first();

    $siswa->update([
        'nama_siswa' => $request->nama_siswa,
        'alamat' => $request->alamat,
        'no_whatsapp' => $request->no_whatsapp,
    ]);

    return redirect()->back()->with('success', 'Profil berhasil diupdate');
}

    public function resetPassword($id)
    {
        try {
            $siswa = \App\Models\Siswa::findOrFail($id);
            if ($siswa->id_user) {
                \App\Models\User::where('id', $siswa->id_user)->update([
                    'password' => \Illuminate\Support\Facades\Hash::make('12345678')
                ]);
                return redirect()->route('siswa.index')->with('success', 'Password siswa berhasil di-reset menjadi 12345678.');
            }
            return redirect()->route('siswa.index')->with('error', 'Siswa tidak memiliki akun user aktif.');
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('error', 'Gagal mereset password siswa.');
        }
    }
}