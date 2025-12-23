<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelanggan;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $pelanggan = pelanggan::create([
                'nama'    => $request->nama,
                'telepon' => $request->telepon,
                'alamat'  => $request->alamat,
            ]);

            $cart = json_decode($request->cart, true);

            $pesanan = Pesanan::create([
                'pelanggan_id' => $pelanggan->id,
                'tanggal_pesanan' => now(),
                'total_harga' => collect($cart)->sum('subtotal'),
                'status_pesanan' => 'pending',
            ]);

            foreach ($cart as $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' => $item['item']['id'],
                    'jumlah_pesanan' => $item['quantity'],
                    'harga_satuan' => $item['item']['currentPrice'],
                    'subtotal' => $item['subtotal'],
                    'keterangan' => $item['notes'] ?? null,
                ]);
            }
        });

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat');
    }
}
