<?php

namespace App\Http\Controllers;
Use App\models\Saran;
Use App\Models\DetailPesanan;
Use App\Models\Pesanan;
Use App\Models\Pelanggan;
Use App\Models\Menu;
use Illuminate\Http\Request;

class AdminControler extends Controller
{
    public function index()
    {
        $saran = Saran::all();
        return view('admin.dashboard', compact('saran'));
    }
    public function view(){
        $menu = Menu::all();
        $pelanggan = Pelanggan::all();
        $pesanan = Pesanan::all();
        $detail_pesanan = DetailPesanan::with('pesanan.pelanggan', 'pesanan.menu')->get();
        return view('admin.pemesanan', compact('menu','pelanggan','pesanan','detail_pesanan'));

    }
}
