<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'kode_pendaftaran',
        'nama_siswa',
        'nama_ortu',
        'no_whatsapp',
        'alamat',
        'jenjang',
        'id_kelas', // Pastikan ini id_kelas sesuai dengan input di form
        'status',
        'tanggal_daftar',
        'keterangan',
    ];

    // Relasi ke tabel Kelas agar pendaftaran tahu dia masuk kelas mana
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function mapels()
    {
        return $this->belongsToMany(MataPelajaran::class, 'pendaftaran_mapel', 'pendaftaran_id', 'mapel_id');
    }
}