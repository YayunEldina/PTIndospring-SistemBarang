<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return redirect()->route('transaksi.index');
});

Route::resource('transaksi', TransaksiController::class);