<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $fillable = [
        'id_user',
        'id_mapel',
        'nama_guru',
        'no_whatsapp',
        'alamat',
    ];

    // RELASI USER
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // RELASI JADWAL
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_guru');
    }

    // RELASI MAPEL
    public function mapel()
    {
        return $this->belongsTo(
            MataPelajaran::class,
            'id_mapel',
            'id_mapel'
        );
    }
}