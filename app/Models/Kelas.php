<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas'
    ];

    // RELASI KE SISWA
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }

    // RELASI KE JADWAL
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas');
    }
}