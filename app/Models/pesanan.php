<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    protected $fillable = [
        'kostumer_id',
        'menu_id',
        'jumlah_pesanan',
        'total_harga',
    ];
    public function pesanan(){
        return $this->hasMany(kostumer::class, 'kostumer_id');
    }
}
