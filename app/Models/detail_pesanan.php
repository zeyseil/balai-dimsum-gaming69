<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_pesanan extends Model
{
    protected $fillable = [
        'pesanan_id',
        'menu_id',
        'jumlah_pesanan',
        'harga_satuan',
        'subtotal',
    ];
}
