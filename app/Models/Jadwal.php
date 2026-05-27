<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_guru',
        'id_kelas',
        'id_mapel',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
    ];

    // RELASI GURU
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    // RELASI KELAS
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
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

    // RELASI SISWA
    public function siswa()
    {
        return $this->belongsToMany(
            Siswa::class,
            'jadwal_siswa',
            'jadwal_id',
            'siswa_id',
            'id_jadwal',
            'id'
        );
    }


}