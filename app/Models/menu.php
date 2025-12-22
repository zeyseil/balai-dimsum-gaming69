<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    
    protected $fillable = [
        'nama_menu',
        'harga_menu',
        'foto_menu',
        'kategori',
        'stock'
    ];

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}