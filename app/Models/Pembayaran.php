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

    public function scopeDueReminders($query)
    {
        // Kirim reminder jika jatuh tempo <= 2 hari ke depan (termasuk yang sudah lewat)
        $batasAkhir = Carbon::now()->addDays(2)->endOfDay();

        return $query->whereIn('status', ['Belum', 'Menunggu'])
            ->whereDate('tanggal_jatuh_tempo', '<=', $batasAkhir)
            ->where(function ($query) {
                $query->where('reminder_count', '<', 3)
                      ->orWhereNull('reminder_count');
            })
            // Hindari kirim reminder lebih dari sekali per hari
            ->where(function ($query) {
                $query->whereNull('last_reminder_sent_at')
                      ->orWhereDate('last_reminder_sent_at', '<', Carbon::today());
            });
    }
}
