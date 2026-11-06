<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterBarang extends Model
{
    protected $table = 'MSBARANG';

    protected $primaryKey = 'KODE_BARANG';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'KODE_BARANG',
        'NAMA_BARANG',
        'SATUAN',
        'KATEGORI',
    ];

    public function detailTransaksi(): HasMany
    {
        return $this->hasMany(
            MutasiDetail::class,
            'KODE_BARANG',
            'KODE_BARANG'
        );
    }
}
