<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MataPelajaran;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'id_user',
        'id_kelas',
        'nama_siswa',
        'alamat',
        'no_whatsapp',
        'status'
    ];

    // RELASI PEMBAYARAN
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_siswa');
    }

    // RELASI KELAS
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    // RELASI JADWAL
    public function jadwal()
    {
        return $this->belongsToMany(
            Jadwal::class,
            'jadwal_siswa',
            'siswa_id',
            'jadwal_id',
            'id',
            'id_jadwal'
        );
    }

    // RELASI MAPEL
    public function mapels()
    {
        return $this->belongsToMany(
            MataPelajaran::class,
            'siswa_mapel',
            'siswa_id',
            'mapel_id',
            'id',
            'id_mapel'
        );
    }

    // RELASI ABSENSI
    public function absensi()
    {
        return $this->hasMany(
            Absensi::class,
            'siswa_id'
        );
    }

    // RELASI NILAI
    public function nilai()
    {
        return $this->hasMany(
            Nilai::class,
            'id_siswa'
        );
    }
}