<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function menu()
    {
        $menuItems = MenuItem::all();
        return view('menu', compact('menuItems'));
    }
}
