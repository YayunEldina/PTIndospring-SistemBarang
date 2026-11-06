<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MutasiHeader extends Model
{
    protected $table = 'trmutasih';

    protected $primaryKey = 'NO_TRANSAKSI';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'NO_TRANSAKSI',
        'TANGGAL',
        'JENIS_TRANSAKSI',
        'KATEGORI',
    ];

    protected $casts = [
        'TANGGAL' => 'date',
    ];

    public function detailTransaksi(): HasMany
    {
        return $this->hasMany(
            MutasiDetail::class,
            'NO_TRANSAKSI',
            'NO_TRANSAKSI'
        );
    }
}