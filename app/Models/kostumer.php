<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kostumer extends Model
{
    protected $fillable = [
        'nama_kostumer',
        'alamat_kostumer',
        'no_telp_kostumer',
    ];
}
