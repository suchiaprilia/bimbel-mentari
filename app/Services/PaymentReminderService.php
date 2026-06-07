<?php

namespace App\Services;

use App\Models\Notifikasi;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PaymentReminderService
{
    protected WhatsAppService $whatsApp;

    public function __construct(WhatsAppService $whatsApp = null)
    {
        $this->whatsApp = $whatsApp ?? new WhatsAppService();
    }

    // ====================================================
    // [CORE-LOGIC] SERVICE PENYUSUN PESAN PENGINGAT
    // Dipanggil oleh cron job atau tombol manual. 
    // Mengambil data dari scopeDueReminders(), lalu menyusun teks pesan WA 
    // berdasarkan sisa hari jatuh tempo.
    // ====================================================
    public function sendDueReminders(): array
    {
        // 1. Ambil data tagihan yang lolos filter anti-spam
        $payments = Pembayaran::with('siswa')
            ->dueReminders()
            ->get();

        $summary = [
            'total' => $payments->count(),
            'sent' => 0,
            'failed' => 0,
            'skipped' => 0,
        ];

        foreach ($payments as $payment) {
            if (!$payment->siswa || empty($payment->siswa->no_whatsapp)) {
                $summary['skipped']++;
                Log::warning('Tidak dapat mengirim pengingat: nomor WA siswa tidak tersedia', [
                    'pembayaran_id' => $payment->id,
                ]);
                continue;
            }

            $dueDate = Carbon::parse($payment->tanggal_jatuh_tempo);
            $today = Carbon::today();
            $sistiHariLagi = $today->diffInDays($dueDate, false); // positif = belum lewat, negatif = sudah lewat
            $dueDateFormatted = $dueDate->translatedFormat('d F Y');
            $bulan = $dueDate->translatedFormat('F');
            $amount = number_format($payment->jumlah, 0, ',', '.');
            $nama = $payment->siswa->nama_siswa;

            // ====================================================
            // [CORE-LOGIC] PENYUSUNAN KATA (COPYWRITING) PESAN WA
            // ====================================================
            if ($sistiHariLagi > 0) {
                // Skenario A: Belum jatuh tempo - kirim pengingat "H-X"
                $message = "⚠️ *Pengingat Pembayaran Bimbingan Belajar*\n\n" .
                    "Halo Bapak/Ibu/Wali dari *{$nama}*,\n\n" .
                    "Kami menginformasikan bahwa tagihan pembayaran bimbingan belajar bulan *{$bulan}* sebesar *Rp{$amount}* akan jatuh tempo dalam *{$sistiHariLagi} hari lagi*, tepatnya pada tanggal *{$dueDateFormatted}*.\n\n" .
                    "Pembayaran dapat dilakukan melalui:\n" .
                    "💵 *Cash* langsung ke admin\n" .
                    "atau\n" .
                    "🏦 *Transfer* ke rekening berikut:\n\n" .
                    "Bank : *BRI*\n" .
                    "No. Rekening : *4557 0100 8242 506*\n" .
                    "Atas Nama : *Suchi Aprilia*\n\n" .
                    "Setelah melakukan pembayaran melalui transfer, mohon mengirimkan bukti pembayaran kepada admin untuk proses konfirmasi.\n\n" .
                    "Mohon segera lakukan pembayaran sebelum jatuh tempo. Terima kasih atas perhatian dan kerja samanya.";
            } else {
                // Skenario B: Sudah lewat jatuh tempo (Keterlambatan)
                $hariTerlambat = abs($sistiHariLagi);
                $message = "🔴 *Tagihan Jatuh Tempo - Bimbingan Belajar*\n\n" .
                    "Halo Bapak/Ibu/Wali dari *{$nama}*,\n\n" .
                    "Kami menginformasikan bahwa tagihan pembayaran bimbingan belajar bulan *{$bulan}* sebesar *Rp{$amount}* telah *melewati jatuh tempo* ({$hariTerlambat} hari).\n\n" .
                    "Pembayaran dapat dilakukan melalui:\n" .
                    "💵 *Cash* langsung ke admin\n" .
                    "atau\n" .
                    "🏦 *Transfer* ke rekening berikut:\n\n" .
                    "Bank : *BRI*\n" .
                    "No. Rekening : *4557 0100 8242 506*\n" .
                    "Atas Nama : *Suchi Aprilia*\n\n" .
                    "Setelah melakukan pembayaran melalui transfer, mohon mengirimkan bukti pembayaran kepada admin untuk proses konfirmasi.\n\n" .
                    "Harap segera melakukan pembayaran atau hubungi admin. Terima kasih atas perhatian dan kerja samanya.";
            }

            // 2. Eksekusi pengiriman ke WhatsApp API
            $sent = $this->whatsApp->sendMessage($payment->siswa->no_whatsapp, $message);

            // 3. Catat riwayat pengiriman ke tabel notifikasi (Log)
            Notifikasi::create([
                'id_pembayaran' => $payment->id,
                'pesan' => $message,
                'target_phone' => $payment->siswa->no_whatsapp,
                'type' => 'reminder',
                'status_kirim' => $sent ? 'Terkirim' : 'Gagal',
                'waktu_kirim' => now(),
            ]);

            if ($sent) {
                $summary['sent']++;
                // Hanya update last_reminder_sent_at jika berhasil dikirim
                $payment->update([
                    'reminder_count' => ($payment->reminder_count ?? 0) + 1,
                    'last_reminder_sent_at' => now(),
                ]);
            } else {
                $summary['failed']++;
            }
        }

        return $summary;
    }
}
