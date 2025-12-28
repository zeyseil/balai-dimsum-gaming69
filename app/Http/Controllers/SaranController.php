<?php

namespace App\Http\Controllers;

use App\Models\Saran;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class SaranController extends Controller
{

    public function index()
    {
        $saran = Saran::all();
        return view('saran', compact('saran'));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:15',
            'isi_saran' => 'required|string',
        ]);

        Saran::create($validatedData);

        return redirect('/')->with('success', 'Saran submitted successfully!');
    }

    public function show(string $id)
    {

    }


    public function edit(string $id)
    {

    }


    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        
    }
}
