<?php

use App\Http\Controllers\AdminControler;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\PageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('/home');
});
Route::get('/menu', [MenuController::class, 'menu'])->name('menu.index');

Route::get('/saran', function () {
    return view('saran');
});
Route::get('/galeri', function () {
    return view('galeri');
});
Route::get('/pesan', function () {
    return view('pesan.popup');
})->name('pesan.popup');

Route::post('/pesan/kirim', [App\Http\Controllers\PesananController::class, 'store'])
    ->name('pesan.kirim');

Route::get('/popup', function () {
    return view('popup');
});
Route::get('/checkout', function () {
    return view('checkout');
});
Route::get('/checkout/{pesanan_id}', [PaymentController::class, 'index'])->name('checkout.show');

Route::post('/pembayaran/store', [PaymentController::class, 'store'])
    ->name('pembayaran.store');


Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');


Route::get('/pesanan', function () {
    return view('pesanan');
});

// ===== LOGIN ROUTES =====
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ===== ADMIN ROUTES - PROTECTED BY MIDDLEWARE =====
Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminControler::class, 'index']);
    Route::get('/penjualan', [AdminControler::class, 'penjualan']);
    Route::get('/stock', function(){
        return view('admin.stock');
    });
    Route::get('/pesanan', [AdminControler::class, 'view'])->name('admin.pesanan');
    Route::patch('/pesanan/{pesanan_id}/update-status', [AdminControler::class, 'updatePesananStatus'])->name('pesanan.updateStatus');
    Route::patch('/pembayaran/{pembayaran_id}/confirm', [AdminControler::class, 'confirmPembayaran'])->name('pembayaran.confirm');
    Route::get('/create', function(){
        return view('admin.buat');
    });
    
    //crud route
    Route::Resource('/stock', MenuController::class);
    Route::get('/admin/stock', [MenuController::class, 'index']);
    Route::get('/admin/buat_menu', [MenuController::class, 'create']);
    Route::post('/admin/stock', [MenuController::class, 'store']);
    Route::get('/admin/stock/{id}/edit', [MenuController::class, 'edit']);
    Route::put('/admin/stock/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/admin/stock/{id}', [MenuController::class, 'destroy']);
});

// ===== PUBLIC ROUTES =====
//resourcee route crud saran
Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');