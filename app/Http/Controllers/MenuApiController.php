<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Response;

class MenuApiController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::all();
        return view('menu');
    }
    public function getItems()
    {
        return response()->json(MenuItem::all(), Response::HTTP_OK);
    }

    public function getItem($id)
    {
        $item = MenuItem::findOrFail($id);
        return response()->json($item, Response::HTTP_OK);
    }
}
