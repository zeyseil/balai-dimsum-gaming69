<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsertDataSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Insert Pelanggan
        $pelanggan = Pelanggan::create([
            'nama' => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 123',
            'no_telepon' => '08123456789'
        ]);

        // Insert Menu
        $menu = Menu::create([
            'nama_menu' => 'Dimsum Spesial',
            'harga_reguler' => 50000,
            'foto_menu' => 'dimsum.jpg',
            'kategori' => 'Makanan',
            'stock' => 100
        ]);

        // Insert Pesanan
        $pesanan = Pesanan::create([
            'pelanggan_id' => $pelanggan->id,
            'tanggal_pesanan' => now()->toDateString(),
            'total_harga' => 50000
        ]);

        // Insert Detail Pesanan
        DetailPesanan::create([
            'pesanan_id' => $pesanan->id,
            'menu_id' => $menu->id,
            'jumlah_pesanan' => 1,
            'harga_satuan' => 50000,
            'subtotal' => 50000,
            'catatan' => 'Tidak pedas'
        ]);
    }
}
