<?php

namespace App\Http\Controllers;

use App\Models\Kostumer;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'alamat' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:15',
        ]);

        Kostumer::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
        ]);

        return redirect('/')
            ->with('success', 'Data kostumer berhasil disimpan');
    }
}