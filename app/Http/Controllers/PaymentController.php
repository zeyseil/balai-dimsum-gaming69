<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index($pesanan_id)
    {
        return view('checkout', compact('pesanan_id'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $file = $request->file('bukti_pembayaran');
        $filename = time() . '.' . $file->extension();
        $file->storeAs('public/bukti', $filename);

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
