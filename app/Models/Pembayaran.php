<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    
    protected $fillable = [
        'pesanan_id',
        'bukti_pembayaran',
        'status_pembayaran',
        'tanggal_pembayaran',
    ];

    protected $casts = [
        'tanggal_pembayaran' => 'datetime'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
