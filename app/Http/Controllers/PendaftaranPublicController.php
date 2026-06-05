<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranPublicController extends Controller
{
    // Tampilkan form pendaftaran
    public function index()
    {
        $kelas = Kelas::all();
        $mapels = MataPelajaran::all();

        return view('daftar', compact('kelas', 'mapels'));
    }

    // Generate kode pendaftaran otomatis
    private function generateKodePendaftaran()
    {
        $tanggal = now()->format('Ymd');
        $urutan = Pendaftaran::count() + 1;

        do {
            $kode = 'BM-' . $tanggal . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
            $urutan++;
        } while (Pendaftaran::where('kode_pendaftaran', $kode)->exists());

        return $kode;
    }

    // Simpan data pendaftaran
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa'  => 'required|string|max:255',
            'nama_ortu'   => 'nullable|string|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'alamat'      => 'nullable|string',
            'jenjang'     => 'required|string|max:50',

            // PERBAIKAN DI SINI
            'id_kelas'    => 'required|exists:kelas,id',

            'mapel_id'    => 'required|array',
            'mapel_id.*'  => 'exists:mata_pelajaran,id_mapel',
        ]);

        DB::beginTransaction();

        try {

            $kodePendaftaran = $this->generateKodePendaftaran();

            // Simpan data pendaftaran
            $pendaftaran = Pendaftaran::create([
                'kode_pendaftaran' => $kodePendaftaran,
                'nama_siswa'       => $request->nama_siswa,
                'nama_ortu'        => $request->nama_ortu,
                'no_whatsapp'      => $request->no_whatsapp,
                'alamat'           => $request->alamat,
                'jenjang'          => $request->jenjang,
                'id_kelas'         => $request->id_kelas,
                'status'           => 'Menunggu',
                'tanggal_daftar'   => now()->toDateString(),
            ]);

            // Simpan mapel yang dipilih
            if ($request->has('mapel_id')) {

                foreach ($request->mapel_id as $mid) {

                    DB::table('pendaftaran_mapel')->insert([
                        'pendaftaran_id' => $pendaftaran->id,
                        'mapel_id'       => $mid,
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ]);
                }
            }

            DB::commit();

            return redirect()->back()->with(
                'success',
                'Pendaftaran berhasil dikirim! Gunakan Nomor WhatsApp Anda untuk mengecek status pendaftaran nanti.'
            );

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->back()->with(
                'error',
                'Terjadi kesalahan: ' . $e->getMessage()
            );
        }
    }

    // Halaman cek status
    public function cekStatus()
    {
        return view('cek-status');
    }

    // Proses cek status
    public function cekStatusProses(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|max:50',
        ]);

        $keyword = trim($request->keyword);

        $pendaftaran = Pendaftaran::where('kode_pendaftaran', $keyword)
            ->orWhere('no_whatsapp', $keyword)
            ->latest()
            ->first();

        if (!$pendaftaran) {

            return redirect()->back()->with(
                'error',
                'Data tidak ditemukan.'
            );
        }

        return view('cek-status', compact('pendaftaran'));
    }
}