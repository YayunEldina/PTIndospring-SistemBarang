<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('transaksi', TransaksiController::class);
Route::resource('transaksi', TransaksiController::class);