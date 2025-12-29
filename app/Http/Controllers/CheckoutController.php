<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelanggan;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'orders' => 'required|array',
                'orders.*.item_id' => 'required|integer',
                'orders.*.nama_menu' => 'required|string',
                'orders.*.type' => 'required|string',
                'orders.*.quantity' => 'required|integer|min:1',
                'orders.*.subtotal' => 'required|numeric',
                'orders.*.notes' => 'nullable|string',
                'total_harga' => 'required|numeric'
            ]);

            DB::beginTransaction();

            $pelanggan = pelanggan::create([
                'nama'    => $request->nama,
                'telepon' => $request->telepon,
                'alamat'  => $request->alamat,
            ]);

            $pesanan = Pesanan::create([
                'pelanggan_id' => $pelanggan->id,
                'tanggal_pesanan' => now(),
                'total_harga' => $request->total_harga,
                'status_pesanan' => 'pending',
            ]);

            foreach ($request->orders as $order) {
                // Ambil data menu
                $menu = Menu::find($order['item_id']);
                if (!$menu) {
                    throw new \Exception("Menu dengan ID {$order['item_id']} tidak ditemukan");
                }

                // Cek dan kurangi stock
                if (!$menu->kurangiStock($order['quantity'])) {
                    throw new \Exception("Stock menu '{$menu->nama_menu}' tidak cukup. Tersedia: {$menu->stock}, Diminta: {$order['quantity']}");
                }

                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' =>  $order['item_id'],
                    'jumlah_pesanan' => $order['quantity'],
                    'harga_satuan' => $order['subtotal'] / $order['quantity'],
                    'subtotal' => $order['subtotal'],
                    'keterangan' => $order['notes'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Pesanan berhasil dibuat');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
