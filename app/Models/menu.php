<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    
    protected $fillable = [
        'nama_menu',
        'harga_menu',
        'harga_reguler',
        'harga_mini',
        'foto_menu',
        'kategori',
        'stock'
    ];

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }

    /**
     * Mengurangi stock menu berdasarkan jumlah pesanan
     * 
     * @param int $jumlah Jumlah yang akan dikurangi dari stock
     * @return bool True jika berhasil, False jika stock tidak cukup
     */
    public function kurangiStock($jumlah)
    {
        if ($this->stock < $jumlah) {
            return false; // Stock tidak cukup
        }

        $this->decrement('stock', $jumlah);
        return true;
    }

    /**
     * Menambah stock menu
     * 
     * @param int $jumlah Jumlah yang akan ditambahkan ke stock
     * @return void
     */
    public function tambahStock($jumlah)
    {
        $this->increment('stock', $jumlah);
    }
}