<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    protected $table = 'saran';
    
    protected $fillable = [
        'nama',
        'no_tlp',
        'isi_saran'
    ];
}