<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'index'])->name('home');
Route::get('/shop', [Controller::class, 'shop'])->name('shop');
Route::get('/transaksi', [Controller::class, 'transaksi'])->name('transaksi');
Route::get('/contact', [Controller::class, 'contact'])->name('contact');


Route::get('/admin', [Controller::class, 'admin'])->name('admin');

Route::resource('admin/product', ProductController::class);
Route::resource('admin/pegawai', PegawaiController::class);

Route::get('/admin/dataPenjualan', [Controller::class, 'dataPenjualan'])->name('dataPenjualan');

