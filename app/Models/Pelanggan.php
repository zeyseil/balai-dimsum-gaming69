<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kostumer extends Model
{
    protected $table = 'kostumer';
    
    protected $fillable = [
        'nama',
        'alamat',
        'no_telepon'
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}