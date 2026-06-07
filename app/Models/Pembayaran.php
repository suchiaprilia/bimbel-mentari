<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'id_siswa',
        'jumlah',
        'tanggal_jatuh_tempo',
        'tanggal_bayar',
        'status',
        'metode_pembayaran',
        'bukti_transfer',
        'reminder_count',
        'last_reminder_sent_at'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'id_pembayaran');
    }

    // ====================================================
    // [CORE-LOGIC] FILTER ANTI-SPAM & PENJADWALAN
    // Fungsi ini menyaring data dari database khusus untuk tagihan yang:
    // 1. Statusnya masih Belum/Menunggu (belum lunas)
    // 2. Waktu jatuh temponya kurang dari atau sama dengan 2 hari ke depan
    // 3. Batas maksimal pengiriman pengingat belum mencapai 3 kali
    // 4. Belum dikirimi pesan HARI INI (Filter Anti-Spam Utama)
    // ====================================================
    public function scopeDueReminders($query)
    {
        // Hitung batas waktu: Hari ini + 2 Hari ke depan (jam 23:59:59)
        $batasAkhir = Carbon::now()->addDays(2)->endOfDay();

        return $query->whereIn('status', ['Belum', 'Menunggu'])
            ->whereDate('tanggal_jatuh_tempo', '<=', $batasAkhir)
            ->where(function ($query) {
                // Syarat: Total reminder yang pernah dikirim harus kurang dari 3
                $query->where('reminder_count', '<', 3)
                      ->orWhereNull('reminder_count');
            })
            ->where(function ($query) {
                // Syarat: Jangan kirim jika kolom last_reminder_sent_at adalah hari ini
                $query->whereNull('last_reminder_sent_at')
                      ->orWhereDate('last_reminder_sent_at', '<', Carbon::today());
            });
    }
}
