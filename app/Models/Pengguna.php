<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'user';
    
    protected $fillable = [
        'username',
        'password',
        'role',
    ];
}
