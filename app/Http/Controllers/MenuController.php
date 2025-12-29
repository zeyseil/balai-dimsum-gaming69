<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function menu()
    {
        $menu = Menu::all();
        return view('menu', compact('menu'));
    }

    public function index()
    {
        $menu = Menu::paginate(10);
        return view('admin.stock', compact('menu'));
    }

    public function create()
    {
        return view('admin.buat_menu');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_menu' => 'required|string|max:255',
            // 'harga_menu' => 'required|numeric',
            'harga_reguler' => 'required|numeric',
            'harga_mini' => 'required|numeric',
            'foto_menu' => 'required|image',
            'kategori' => 'required|string|max:100',
            'stock' => 'required|integer',
        ]); 
        $foto =null;
        if ($request->hasFile('foto_menu')) {
            $foto = $request->file('foto_menu')->store('images', 'public');
    }
    Menu::create([
        'nama_menu' => $request->nama_menu,
        // 'harga_menu' => $request->harga_menu,
        'harga_reguler' => $request->harga_reguler,
        'harga_mini' => $request->harga_mini,
        'foto_menu' => $foto,
        'kategori' => $request->kategori,
        'stock' => $request->stock,
    ]);

        return redirect('/stock')->with('success', 'Menu created successfully');
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.edit_menu', compact('menu'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_menu' => 'required|string|max:255',
            // 'harga_menu' => 'required|numeric',
            'harga_reguler' => 'required|numeric',
            'harga_mini' => 'required|numeric',
            'foto_menu' => 'nullable|image',
            'kategori' => 'required|string|max:100',
            'stock' => 'required|integer',
        ]);
        if ($request->hasFile('foto_menu')) {
            if ($request->image && storage::disk('public')->exists($request->image)) {
                storage::disk('public')->delete($request->image);
            }
            $validatedData['foto_menu'] = $request->file('foto_menu')->store('images', 'public');
        }
        Menu::findOrFail($id)->update($validatedData);
        return redirect('/stock')->with('success', 'Menu updated successfully');
    }

    public function destroy(string $id)
    {
        $daya = Menu::find($id);
        if ($daya->foto_menu && Storage::disk('public')->exists($daya->foto_menu)) {
            Storage::disk('public')->delete($daya->foto_menu);
        }

        $daya->delete();
        return redirect('/stock')->with('success', 'Menu deleted successfully');
    }
}