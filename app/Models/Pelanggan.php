<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    
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