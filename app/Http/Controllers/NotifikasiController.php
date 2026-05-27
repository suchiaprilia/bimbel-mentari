<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Notifikasi::with('pembayaran.siswa')->latest();

        if ($request->search) {
            $query->where('pesan', 'like', '%' . $request->search . '%')
                  ->orWhere('target_phone', 'like', '%' . $request->search . '%');
        }

        $notifikasi = $query->paginate(15);

        return view('notifikasi', compact('notifikasi'));
    }

    public function clearAll()
    {
        Notifikasi::truncate();
        return redirect()->back()->with('success', 'Semua riwayat notifikasi berhasil dihapus.');
    }
}
