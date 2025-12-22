<?php

use App\Http\Controllers\AdminControler;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\PageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SaranController;


Route::get('/', function () {
    return view('/home');
});
Route::get('/menu');

Route::get('/saran', function () {
    return view('saran');
});
Route::get('/galeri', function () {
    return view('galeri');
});
// Route::get('/pesanan', function () {
//     return view('pesanan');
// });
Route::get('/admin', function(){
    return view('admin.dashboard');
});
Route::get('/login', function(){
    return view('admin.login');
});
Route::get('/penjualan', function(){
    return view('admin.penjualan');
});
Route::get('/stock', function(){
    return view('admin.stock');
});
Route::get('/pesanan', function(){
    return view('admin.pemesanan');
});

//crud route
Route::get('/create', function(){
    return view('admin.buat');
});
//resousrce route crud 
Route::Resource('/stock', MenuController::class);
Route::get('/admin/stock', [MenuController::class, 'index']);
Route::get('/admin/buat_menu', [MenuController::class, 'create']);
Route::post('/admin/stock', [MenuController::class, 'store']);
Route::get('/admin/stock/{id}/edit', [MenuController::class, 'edit']);
Route::put('/admin/stock/{id}', [MenuController::class, 'update'])->name('menu.update');
Route::delete('/admin/stock/{id}', [MenuController::class, 'destroy']);

//resourcee route crud saran
Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');
Route::get('/admin', [AdminControler::class, 'index']);
