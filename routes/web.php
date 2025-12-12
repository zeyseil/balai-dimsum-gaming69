<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MenuController;


Route::get('/', function () {
    return view('home');
});
Route::get('/menu', [PageController::class, 'menu'])->name('menu');

Route::get('/saran', function () {
    return view('saran');
});
Route::get('/galeri', function () {
    return view('galeri');
});
Route::get('/pesanan', function () {
    return view('pesanan');
});