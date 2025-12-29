<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        // Jika sudah login, redirect ke admin
        if (session('admin_logged_in')) {
            return redirect('/admin');
        }
        return view('admin.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $pengguna = Pengguna::where('username', $request->username)->first();

        // Validasi username dan password
        if ($pengguna && $pengguna->password === $request->password) {
            // Set session admin
            session([
                'admin_logged_in' => true,
                'admin_id' => $pengguna->id,
                'admin_username' => $pengguna->username,
                'admin_role' => $pengguna->role,
            ]);

            return redirect('/admin')->with('success', 'Login berhasil');
        }

        return back()->with('error', 'Username atau password salah');
    }

    // Logout
    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id', 'admin_username', 'admin_role']);
        session()->flush();
        
        return redirect('/login')->with('success', 'Anda telah logout');
    }
}
