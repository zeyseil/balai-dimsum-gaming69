<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    
    protected $fillable = [
        'pelanggan_id',
        'menu_id',
        'tanggal_pesanan',
        'total_harga'   
    ];

    protected $casts = [
        'tanggal_pesanan' => 'date'
    ];

    public function kostumer()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}