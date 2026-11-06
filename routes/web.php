<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return redirect()->route('transaksi.index');
});

Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan'])
    ->name('transaksi.laporan');

Route::resource('transaksi', TransaksiController::class)
    ->except(['show']);
