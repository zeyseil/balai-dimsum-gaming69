<?php

namespace App\Http\Controllers;

use App\Models\Saran;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class SaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saran = Saran::all();
        return view('saran', compact('saran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view("saran");
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
