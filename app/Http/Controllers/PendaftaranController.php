<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Notifikasi;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $pendaftarans = Pendaftaran::when($search, function($q) use ($search) {
            $q->where('nama_siswa', 'like', "%{$search}%")
              ->orWhere('no_whatsapp', 'like', "%{$search}%")
              ->orWhere('kode_pendaftaran', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('pendaftaran', compact('pendaftarans'));
    }

    public function simpanTerima($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        if ($pendaftaran->status == 'Diterima') {

            return redirect()->back()
                ->with('error', 'Pendaftaran ini sudah diterima sebelumnya.');
        }

        // Cari kelas berdasarkan id_kelas
        $kelas = Kelas::find($pendaftaran->id_kelas);

        if (!$kelas) {

            return redirect()->back()
                ->with('error', 'Kelas tidak ditemukan.');
        }

        // Buat atau ambil akun login siswa berdasarkan nomor WA
        $user = User::where('no_wa', $pendaftaran->no_whatsapp)->first();

        if (!$user) {
            $user = User::create([
                'no_wa'    => $pendaftaran->no_whatsapp,
                'password' => Hash::make('12345678'),
                'level'    => 'siswa',
            ]);
        }

        // Simpan siswa (atau update jika sudah ada)
        $siswa = Siswa::updateOrCreate(
            ['no_whatsapp' => $pendaftaran->no_whatsapp],
            [
                'id_user'     => $user->id,
                'id_kelas'    => $kelas->id,
                'nama_siswa'  => $pendaftaran->nama_siswa,
                'alamat'      => $pendaftaran->alamat,
                'no_whatsapp' => $pendaftaran->no_whatsapp,
                'status'      => 'Aktif',
            ]
        );

        // AMBIL MAPEL DARI PENDAFTARAN
        $mapels = DB::table('pendaftaran_mapel')
            ->where('pendaftaran_id', $pendaftaran->id)
            ->pluck('mapel_id');

        // SIMPAN KE siswa_mapel
        foreach ($mapels as $mid) {

            DB::table('siswa_mapel')->insert([
                'siswa_id'   => $siswa->id,
                'mapel_id'   => $mid,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Update status pendaftaran
        $pendaftaran->status = 'Diterima';

        $pendaftaran->keterangan =
            'Pendaftaran diterima. Akun siswa telah dibuat. 
            Login menggunakan No WhatsApp dan password default 12345678.';

        $pendaftaran->save();

        // KIRIM NOTIFIKASI WA
        if (!empty($pendaftaran->no_whatsapp)) {
            $wa = new WhatsAppService();
            $pesan = "🎉 *Selamat! Pendaftaran Diterima*\n\n" .
          "Halo Bapak/Ibu/Wali dari *{$pendaftaran->nama_siswa}*,\n\n" .
          "Kami informasikan bahwa pendaftaran putra/putri Anda di *Bimbel Mentari* telah *DITERIMA*.\n\n" .
          "Sekarang Anda dapat login ke dashboard siswa menggunakan:\n" .
          "🌐 URL: " . url('/login') . "\n" .
          "📱 No. WA: *{$pendaftaran->no_whatsapp}*\n" .
          "🔑 Password: *12345678*\n\n" .
          "Mohon segera ganti password Anda setelah login pertama kali demi keamanan.\n\n" .
          "Kami juga mengharapkan Bapak/Ibu/Wali untuk membuka website *Bimbel Mentari* secara berkala agar dapat mengetahui informasi terbaru terkait jadwal bimbel, materi, tugas, maupun pengumuman lainnya.\n\n" .
          "Selamat bergabung dan semoga mendapatkan pengalaman belajar yang menyenangkan bersama *Bimbel Mentari*! ✨";
            
            $terkirim = $wa->sendMessage($pendaftaran->no_whatsapp, $pesan);

            Notifikasi::create([
                'pesan' => $pesan,
                'target_phone' => $pendaftaran->no_whatsapp,
                'type' => 'pendaftaran',
                'status_kirim' => $terkirim ? 'Terkirim' : 'Gagal',
                'waktu_kirim' => now()
            ]);
        }

        return redirect()->route('pendaftaran.index')
            ->with(
                'success',
                'Pendaftaran diterima dan akun siswa berhasil dibuat.'
            );
    }

    public function tolak(\Illuminate\Http\Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->status = 'Ditolak';

        $pendaftaran->keterangan = $request->alasan ?? 'Pendaftaran ditolak oleh admin.';

        $pendaftaran->save();

        return redirect()->back()
            ->with('success', 'Pendaftaran ditolak.');
    }
}