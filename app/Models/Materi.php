<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';

    protected $fillable = [
        'id_guru',
        'id_kelas',
        'id_mapel',
        'judul_materi',
        'deskripsi',
        'file_materi',
        'tanggal_upload',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function mapel()
{
    return $this->belongsTo(MataPelajaran::class, 'id_mapel');
}
}
