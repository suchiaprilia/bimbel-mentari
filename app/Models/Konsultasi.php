<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';

    protected $fillable = [
        'id_siswa',
        'id_guru',
        'topik',
        'pertanyaan',
        'jawaban',
        'status',
        'is_read_siswa',
    ];

    /**
     * Relasi ke Siswa (Pengirim Pertanyaan)
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    /**
     * Relasi ke Guru (Penerima Pertanyaan)
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
