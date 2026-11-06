<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MutasiDetail extends Model
{
    protected $table = 'TRMUTASIDT';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'NO_TRANSAKSI',
        'KODE_BARANG',
        'QTY',
    ];

    protected $casts = [
        'QTY' => 'integer',
    ];

    public function header(): BelongsTo
    {
        return $this->belongsTo(
            MutasiHeader::class,
            'NO_TRANSAKSI',
            'NO_TRANSAKSI'
        );
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(
            MasterBarang::class,
            'KODE_BARANG',
            'KODE_BARANG'
        );
    }
}