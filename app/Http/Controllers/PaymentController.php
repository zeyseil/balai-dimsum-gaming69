<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index($pesanan_id)
    {
        $pesanan = \App\Models\Pesanan::with(['detailPesanan.menu', 'pelanggan'])->find($pesanan_id);
        if (!$pesanan) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan');
        }
        $detailPesanan = $pesanan->detailPesanan;
        return view('checkout', [
            'pesanan_id' => $pesanan_id,
            'pesanan' => $pesanan,
            'detailPesanan' => $detailPesanan
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $file = $request->file('bukti_pembayaran');
        $filename = time() . '.' . $file->extension();
        
        // Simpan langsung ke public folder agar bisa diakses
        $file->move(public_path('bukti'), $filename);

        Pembayaran::create([
            'pesanan_id' => $request->pesanan_id,
            'bukti_pembayaran' => $filename,
            'status_pembayaran' => 'pending',
            'tanggal_pembayaran' => Carbon::now()
        ]);

return redirect('/menu')
    ->with('pesanan_dikirim', true);
    }
}
