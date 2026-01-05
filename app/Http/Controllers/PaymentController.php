<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pelanggan;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index($pesanan_id)
    {
        // Ambil pesanan beserta relasi pelanggan
        $pesanan = \App\Models\Pesanan::with(['detailPesanan.menu', 'pelanggan'])->find($pesanan_id);
        
        if (!$pesanan) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan');
        }
    
        $detailPesanan = $pesanan->detailPesanan;
        $pelanggan = $pesanan->pelanggan; // Ambil pelanggan dari relasi
    
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Data pelanggan tidak ditemukan');
        }
    
        return view('checkout', [
            'pesanan_id' => $pesanan_id,
            'pesanan' => $pesanan,
            'detailPesanan' => $detailPesanan,
            'pelanggan' => $pelanggan
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'pesanan_id' => 'required|integer|exists:pesanan,id',
                'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $file = $request->file('bukti_pembayaran');
            $filename = time() . '.' . $file->extension();
            
            // Buat folder jika belum ada
            if (!file_exists(public_path('bukti'))) {
                mkdir(public_path('bukti'), 0755, true);
            }
            
            // Simpan langsung ke public folder agar bisa diakses
            $file->move(public_path('bukti'), $filename);

            Pembayaran::create([
                'pesanan_id' => $request->pesanan_id,
                'bukti_pembayaran' => $filename,
                'status_pembayaran' => 'pending',
                'tanggal_pembayaran' => Carbon::now()
            ]);

            return redirect('/menu')
                ->with('pesanan_dikirim', true)
                ->with('success', 'Pembayaran berhasil dikirim! Mohon tunggu konfirmasi admin.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Validasi gagal. Pastikan file adalah gambar dengan format JPG/PNG dan ukuran maksimal 2MB');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
