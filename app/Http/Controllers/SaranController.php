<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saran;

class SaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'telepon'  => 'required|numeric',
            'saran'    => 'required|max:1000',
        ]);

        Saran::create($request->all());

        return redirect()->back()->with('success', 'Terima kasih atas saran Anda!');
    }
}
