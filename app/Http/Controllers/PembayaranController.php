<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Notifikasi;
use App\Services\PaymentReminderService;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function tagihan(Request $request)
    {
        $search = $request->query('search');
        
        $tagihan = Pembayaran::with('siswa')
            ->when($search, function($q) use ($search) {
                $q->whereHas('siswa', function($q) use ($search) {
                    $q->where('nama_siswa', 'like', "%{$search}%");
                })->orWhere('status', 'like', "%{$search}%");
            })
            ->orderBy('tanggal_jatuh_tempo', 'asc')
            ->paginate(10);

        return view('tagihan', [
            'tagihan' => $tagihan,
            'siswa' => Siswa::all(),
            'editTagihan' => null
        ]);
    }

    public function tagihanEdit(Request $request, $id)
    {
        $search = $request->query('search');
        
        $tagihan = Pembayaran::with('siswa')
            ->when($search, function($q) use ($search) {
                $q->whereHas('siswa', function($q) use ($search) {
                    $q->where('nama_siswa', 'like', "%{$search}%");
                })->orWhere('status', 'like', "%{$search}%");
            })
            ->orderBy('tanggal_jatuh_tempo', 'asc')
            ->paginate(10);

        return view('tagihan', [
            'tagihan' => $tagihan,
            'siswa' => Siswa::all(),
            'editTagihan' => Pembayaran::findOrFail($id)
        ]);
    }

    public function index(Request $request)
    {
        $pembayaranQuery = Pembayaran::with('siswa')
            ->orderBy('tanggal_jatuh_tempo', 'asc');

        $allPembayaran = $pembayaranQuery->get();
        $summary = [
            'totalTagihan' => $allPembayaran->sum('jumlah'),
            'belum' => $allPembayaran->where('status', 'Belum')->sum('jumlah'),
            'menunggu' => $allPembayaran->where('status', 'Menunggu')->sum('jumlah'),
            'lunas' => $allPembayaran->where('status', 'Lunas')->sum('jumlah'),
            'count' => $allPembayaran->count(),
        ];

        $search = $request->query('search');
        $pembayaran = Pembayaran::with('siswa')
            ->when($search, function($q) use ($search) {
                $q->whereHas('siswa', function($q) use ($search) {
                    $q->where('nama_siswa', 'like', "%{$search}%");
                })->orWhere('status', 'like', "%{$search}%");
            })
            ->orderBy('tanggal_jatuh_tempo', 'asc')
            ->paginate(10);

        return view('pembayaran', [
            'pembayaran' => $pembayaran,
            'summary' => $summary,
            'siswa' => Siswa::all(),
            'editPembayaran' => null,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $editPembayaran = Pembayaran::findOrFail($id);

        $pembayaranQuery = Pembayaran::with('siswa')
            ->orderBy('tanggal_jatuh_tempo', 'asc');

        $allPembayaran = $pembayaranQuery->get();
        $summary = [
            'totalTagihan' => $allPembayaran->sum('jumlah'),
            'belum' => $allPembayaran->where('status', 'Belum')->sum('jumlah'),
            'menunggu' => $allPembayaran->where('status', 'Menunggu')->sum('jumlah'),
            'lunas' => $allPembayaran->where('status', 'Lunas')->sum('jumlah'),
            'count' => $allPembayaran->count(),
        ];

        $search = $request->query('search');
        $pembayaran = Pembayaran::with('siswa')
            ->when($search, function($q) use ($search) {
                $q->whereHas('siswa', function($q) use ($search) {
                    $q->where('nama_siswa', 'like', "%{$search}%");
                })->orWhere('status', 'like', "%{$search}%");
            })
            ->orderBy('tanggal_jatuh_tempo', 'asc')
            ->paginate(10);

        return view('pembayaran', [
            'pembayaran' => $pembayaran,
            'summary' => $summary,
            'siswa' => Siswa::all(),
            'editPembayaran' => $editPembayaran,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_siswa' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal_jatuh_tempo' => 'required',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'id_siswa' => $request->id_siswa,
            'jumlah' => $request->jumlah,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Tagihan berhasil diperbarui.');
    }

    public function tagihanUpdate(Request $request, $id)
    {
        $request->validate([
            'id_siswa' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal_jatuh_tempo' => 'required',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'id_siswa' => $request->id_siswa,
            'jumlah' => $request->jumlah,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
        ]);

        return redirect('/tagihan')->with('success', 'Tagihan berhasil diperbarui.');
    }

    public function tagihanDestroy($id)
    {
        Pembayaran::destroy($id);
        return redirect('/tagihan')->with('success', 'Tagihan berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal_jatuh_tempo' => 'required',
        ]);

        $jumlahFormatted = number_format($request->jumlah, 0, ',', '.');
        $jatuhTempo = \Carbon\Carbon::parse($request->tanggal_jatuh_tempo)->translatedFormat('d F Y');
        $bulan = \Carbon\Carbon::parse($request->tanggal_jatuh_tempo)->translatedFormat('F');
        
        $countSuccess = 0;
        
        // Handle both single string or array of IDs
        $idSiswaList = is_array($request->id_siswa) ? $request->id_siswa : [$request->id_siswa];

        foreach ($idSiswaList as $idSiswa) {
            $pembayaran = Pembayaran::create([
                'id_siswa' => $idSiswa,
                'jumlah' => $request->jumlah,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'status' => 'Belum',
                'metode_pembayaran' => 'transfer',
                'tanggal_bayar' => null,
                'bukti_transfer' => null
            ]);

            // Load siswa untuk kirim WA
            $pembayaran->load('siswa');
            $siswa = $pembayaran->siswa;

            if ($siswa) {
                $pesan = "✅ *Tagihan Pembayaran Bimbingan Belajar*\n\n" .
                    "Halo Bapak/Ibu/Wali dari *{$siswa->nama_siswa}*,\n\n" .
                    "Admin Bimbel Mentari telah membuat tagihan pembayaran baru untuk bulan *{$bulan}* sebesar *Rp{$jumlahFormatted}*.\n\n" .
                    "📅 Jatuh Tempo : *{$jatuhTempo}*\n\n" .
                    "Pembayaran dapat dilakukan melalui:\n" .
                    "💵 *Cash* langsung ke admin\n" .
                    "atau\n" .
                    "🏦 *Transfer* ke rekening berikut:\n\n" .
                    "Bank : *BRI*\n" .
                    "No. Rekening : *4557 0100 8242 506*\n" .
                    "Atas Nama : *Suchi Aprilia*\n\n" .
                    "Setelah melakukan pembayaran melalui transfer, mohon mengirimkan bukti pembayaran kepada admin untuk proses konfirmasi.\n\n" .
                    "Terima kasih atas perhatian dan kerja samanya.\n";

                $statusKirim = 'Gagal';
                $targetPhone = $siswa->no_whatsapp ?? null;

                if (!empty($targetPhone)) {
                    $wa = new WhatsAppService();
                    $terkirim = $wa->sendMessage($targetPhone, $pesan);
                    $statusKirim = $terkirim ? 'Terkirim' : 'Gagal';
                }

                Notifikasi::create([
                    'id_pembayaran' => $pembayaran->id,
                    'pesan' => $pesan,
                    'target_phone' => $targetPhone,
                    'type' => 'pembayaran',
                    'status_kirim' => $statusKirim,
                    'waktu_kirim' => now()
                ]);
                
                $countSuccess++;
            }
        }

        return redirect()->back()->with('success', "Sebanyak {$countSuccess} tagihan berhasil dibuat dan notifikasi WA telah diproses.");
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'metode_pembayaran' => 'required|in:cash,transfer'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        $bukti = null;
        $status = 'Belum';

        if ($request->metode_pembayaran === 'cash') {
            $status = 'Lunas';
            $tanggal_bayar = now();
        } elseif ($request->hasFile('bukti_transfer')) {
            $status = 'Menunggu';
            $bukti = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            $tanggal_bayar = null;
        }

        $pembayaran->update([
            'status' => $status,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_transfer' => $bukti,
            'tanggal_bayar' => $tanggal_bayar ?? $pembayaran->tanggal_bayar
        ]);

        Notifikasi::create([
            'id_pembayaran' => $pembayaran->id,
            'pesan' => $status === 'Lunas' 
                ? 'Pembayaran tunai dicatat.' 
                : 'Bukti transfer diterima dan menunggu verifikasi.',
            'target_phone' => $pembayaran->siswa->no_whatsapp ?? null,
            'type' => 'sistem',
            'waktu_kirim' => now()
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload.');
    }

    public function destroy($id)
    {
        Pembayaran::destroy($id);
        return redirect('/pembayaran');
    }

    public function verifikasi($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([
            'status' => 'Lunas',
            'tanggal_bayar' => now()
        ]);

        Notifikasi::create([
            'id_pembayaran' => $pembayaran->id,
            'pesan' => 'Pembayaran diverifikasi dan status diubah menjadi Lunas.',
            'target_phone' => $pembayaran->siswa->no_whatsapp ?? null,
            'type' => 'sistem',
            'waktu_kirim' => now()
        ]);

        return redirect('/pembayaran');
    }

    public function bayarTunai($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([
            'status' => 'Lunas',
            'tanggal_bayar' => now(),
            'metode_pembayaran' => 'cash'
        ]);

        Notifikasi::create([
            'id_pembayaran' => $pembayaran->id,
            'pesan' => 'Pembayaran dicatat sebagai tunai dan status menjadi Lunas.',
            'target_phone' => $pembayaran->siswa->no_whatsapp ?? null,
            'type' => 'sistem',
            'waktu_kirim' => now()
        ]);

        return redirect('/pembayaran');
    }

    public function kirimReminder(PaymentReminderService $reminderService)
    {
        $result = $reminderService->sendDueReminders();

        $message = sprintf(
            'Pengingat terkirim: %d berhasil, %d gagal, %d dilewati.',
            $result['sent'],
            $result['failed'],
            $result['skipped']
        );

        return redirect('/pembayaran')->with('success', $message);
    }
}
