<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipAbsensi extends Model
{
    protected $table = 'arsip_absensis';
    protected $fillable = ['judul_arsip', 'tanggal', 'file_path', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
