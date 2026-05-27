<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginProses(Request $request)
    {
        $no_wa = $request->no_wa;

        // Normalisasi nomor WA: hilangkan karakter non-digit
        $no_wa = preg_replace('/[^0-9]/', '', $no_wa);

        // Jika dimulai dengan 62, ubah jadi 0
        if (strpos($no_wa, '62') === 0) {
            $no_wa = '0' . substr($no_wa, 2);
        }
        
        // Pastikan format tetap 08...
        if (strpos($no_wa, '0') !== 0 && strlen($no_wa) > 0) {
            $no_wa = '0' . $no_wa;
        }

        if (Auth::attempt([
            'no_wa' => $no_wa,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->level == 'admin') {
                return redirect('/beranda');
            } elseif ($user->level == 'guru') {
                return redirect('/guru-dashboard');
            } elseif ($user->level == 'siswa') {
                return redirect('/siswa-dashboard');
            }

            return redirect('/');
        }

        return back()->with('error', 'Login gagal. Periksa nomor WhatsApp dan password Anda.');
    }

    public function ubahPassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect('/login')->with('error_password', 'User tidak ditemukan');
        }

        // cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with('error_password', 'Password lama salah');
        }

        // update password
        $user->update([
            'password' => Hash::make($request->password_baru)
        ]);

        return back()->with('success_password', 'Password berhasil diubah 🎉');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // hapus session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout');
    }
}