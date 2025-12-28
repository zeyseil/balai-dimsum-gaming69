<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validasi input dasar
            $request->validate([
                'nama' => 'required|string|max:50',
                'alamat' => 'required|string|max:100',
                'no_telepon' => 'required|string|max:15',
                'orders' => 'required|string', // orders dikirim sebagai JSON string
                'total_harga' => 'required|numeric|min:0'
            ]);

            // Decode JSON string menjadi array
            $orders = json_decode($request->orders, true);
            
            // Validasi hasil decode
            if (empty($orders) || !is_array($orders)) {
                Log::error('Orders tidak valid', ['orders' => $request->orders]);
                return redirect()->back()->with('error', 'Format pesanan tidak valid');
            }

            // Debug log
            Log::info('Orders received', ['orders' => $orders]);

            // Mulai database transaction
            DB::beginTransaction();

            // Simpan data pelanggan
            $pelanggan = Pelanggan::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
            ]);

            // Loop setiap order untuk menyimpan pesanan dan detail pesanan
            foreach ($orders as $order) {
                // Validasi setiap item order
                if (!isset($order['item_id']) || !isset($order['quantity']) || !isset($order['subtotal'])) {
                    Log::warning('Invalid order item', ['order' => $order]);
                    continue; // Skip item yang tidak valid
                }
                
                // Simpan data pesanan
                $pesanan = Pesanan::create([
                    'pelanggan_id' => $pelanggan->id,
                    'menu_id' => $order['item_id'],
                    'tanggal_pesanan' => now(),
                    'total_harga' => $order['subtotal'], // total per item
                    'status_pesanan' => 'pending',
                ]);

                // Simpan detail pesanan
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' => $order['item_id'],
                    'jumlah_pesanan' => $order['quantity'],
                    'harga_satuan' => ($order['quantity'] > 0) ? ($order['subtotal'] / $order['quantity']) : 0,
                    'subtotal' => $order['subtotal'],
                    'catatan' => $order['notes'] ?? null,
                ]);
            }

            // Commit transaction
            DB::commit();

            Log::info('Pesanan berhasil disimpan', [
                'pelanggan_id' => $pelanggan->id,
                'total_items' => count($orders)
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('menu')
                ->with('success', 'Pesanan berhasil disimpan!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Validation error', ['errors' => $e->errors()]);
            
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Data tidak valid');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat menyimpan pesanan', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}