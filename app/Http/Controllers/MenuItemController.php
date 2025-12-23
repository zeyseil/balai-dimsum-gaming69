<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\DB;

class MenuItemController extends Controller
{
    public function menu()
    {
        $menu = Menu::all();
        return view('menu', compact('menu'));
    }

    public function store(Request $request)
    {
        try {
            // Validasi data yang masuk
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

            // Gunakan database transaction untuk memastikan data consistency
            DB::beginTransaction();

            // Simpan data ke tabel pesanan
            $pesanan = Pesanan::create([
                'tanggal_pesananan' => now(),
                'total_harga' => $request->total_harga,
                'status_pesanan' => 'pending', // bisa disesuaikan: pending, processing, completed
            ]);

            // Simpan setiap item ke tabel detail_pesanan
            foreach ($request->orders as $order) {
                DetailPesanan::create([
                    'id' => $pesanan->id,
                    'menu_id' => $order['item_id'],
                    'nama_pesanan' => $order['nama_menu'],
                    'tipe' => $order['type'], // reguler atau mini
                    'jumlah_pesanan' => $order['quantity'],
                    'harga_satuan' => $order['subtotal'] / $order['quantity'],
                    'subtotal' => $order['subtotal'],
                    'catatan' => $order['notes'] ?? null,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil disimpan!',
                'pesanan_id' => $pesanan->id,
                'data' => $pesanan
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Method untuk melihat detail pesanan
    public function show($id)
    {
        try {
            $pesanan = Pesanan::with('detailPesanan')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $pesanan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }
    }

    // Method untuk melihat semua pesanan
    public function index()
    {
        $pesanan = Pesanan::with('detailPesanan')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $pesanan
        ]);
    }

}

