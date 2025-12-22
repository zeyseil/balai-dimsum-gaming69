<?php

namespace App\Http\Controllers;
Use App\models\Saran;
use Illuminate\Http\Request;

class AdminControler extends Controller
{
    public function index()
    {
        $saran = Saran::all();
        return view('admin.dashboard', compact('saran'));
    }
}
