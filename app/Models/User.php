<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';

    protected $fillable = [
        'no_wa',
        'password',
        'level',
    ];

    protected $hidden = [
        'password',
    ];
}