<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\MutasiHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TransaksiController extends Controller
{
    // Menampilkan seluruh transaksi
    public function index()
    {
        $transaksi = MutasiHeader::with('detailTransaksi.barang')
            ->orderBy('TANGGAL', 'desc')
            ->get();

       return view('transaksi.dashboard', compact('transaksi'));
    }

    // Menampilkan form tambah transaksi
   public function create()
{
    $barang = MasterBarang::orderBy('NAMA_BARANG')->get();

   return view('transaksi.data-transaksi', compact('barang'));
}

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'NO_TRANSAKSI' => 'required|string|max:5|unique:TRMUTASIH,NO_TRANSAKSI',
            'TANGGAL' => 'required|date',
            'JENIS_TRANSAKSI' => 'required|in:MASUK,KELUAR',
            'KATEGORI' => 'required|in:SUBMAT,RAWMAT',

            'detail' => 'required|array|min:1',
            'detail.*.KODE_BARANG' => [
                'required',
                'distinct',
                'exists:MSBARANG,KODE_BARANG'
            ],
            'detail.*.QTY' => 'required|integer|min:1',
        ]);

        // Memastikan kategori barang sesuai kategori transaksi
        $kodeBarang = collect($data['detail'])
            ->pluck('KODE_BARANG');

        $kategoriTidakSesuai = DB::table('MSBARANG')
            ->whereIn('KODE_BARANG', $kodeBarang)
            ->where('KATEGORI', '<>', $data['KATEGORI'])
            ->exists();

        if ($kategoriTidakSesuai) {
            return back()
                ->withErrors(['detail' => 'Kategori barang tidak sesuai dengan transaksi.'])
                ->withInput();
        }

        DB::transaction(function () use ($data) {
            MutasiHeader::create([
                'NO_TRANSAKSI' => $data['NO_TRANSAKSI'],
                'TANGGAL' => $data['TANGGAL'],
                'JENIS_TRANSAKSI' => $data['JENIS_TRANSAKSI'],
                'KATEGORI' => $data['KATEGORI'],
            ]);

            foreach ($data['detail'] as $detail) {
                DB::table('TRMUTASIDT')->insert([
                    'NO_TRANSAKSI' => $data['NO_TRANSAKSI'],
                    'KODE_BARANG' => $detail['KODE_BARANG'],
                    'QTY' => $detail['QTY'],
                ]);
            }
        });

            return redirect()
                ->route('transaksi.create')
                ->with('success', 'Transaksi berhasil disimpan!');
    }

    // Menampilkan form edit transaksi
    public function edit($noTransaksi)
    {
        $transaksi = MutasiHeader::with('detailTransaksi')
            ->findOrFail($noTransaksi);

        $barang = MasterBarang::where(
            'KATEGORI',
            $transaksi->KATEGORI
        )->orderBy('NAMA_BARANG')->get();

        return view('transaksi.edit-transaksi', compact('transaksi', 'barang'));
    }

    // Memperbarui transaksi
public function update(Request $request, $noTransaksi)
{
    $transaksi = MutasiHeader::findOrFail($noTransaksi);

    $data = $request->validate([
        'TANGGAL' => 'required|date',
        'JENIS_TRANSAKSI' => 'required|in:MASUK,KELUAR',
        'KATEGORI' => 'required|in:SUBMAT,RAWMAT',

        'detail' => 'required|array|min:1',
        'detail.*.KODE_BARANG' => [
            'required',
            'distinct',
            'exists:MSBARANG,KODE_BARANG'
        ],
        'detail.*.QTY' => 'required|integer|min:1',
    ]);

    // Memastikan kategori barang sesuai kategori transaksi
    $kodeBarang = collect($data['detail'])
        ->pluck('KODE_BARANG');

    $kategoriTidakSesuai = DB::table('MSBARANG')
        ->whereIn('KODE_BARANG', $kodeBarang)
        ->where('KATEGORI', '<>', $data['KATEGORI'])
        ->exists();

    if ($kategoriTidakSesuai) {
        return back()
            ->withErrors([
                'detail' => 'Kategori barang tidak sesuai dengan transaksi.'
            ])
            ->withInput();
    }

    DB::transaction(function () use ($transaksi, $data) {

        // Memperbarui data header transaksi
        $transaksi->update([
            'TANGGAL' => $data['TANGGAL'],
            'JENIS_TRANSAKSI' => $data['JENIS_TRANSAKSI'],
            'KATEGORI' => $data['KATEGORI'],
        ]);

        // Menghapus detail transaksi sebelumnya
        DB::table('TRMUTASIDT')
            ->where('NO_TRANSAKSI', $transaksi->NO_TRANSAKSI)
            ->delete();

        // Menyimpan kembali detail transaksi terbaru
        foreach ($data['detail'] as $detail) {
            DB::table('TRMUTASIDT')->insert([
                'NO_TRANSAKSI' => $transaksi->NO_TRANSAKSI,
                'KODE_BARANG' => $detail['KODE_BARANG'],
                'QTY' => $detail['QTY'],
            ]);
        }
    });

    return redirect()
        ->route('transaksi.index')
        ->with('success', 'Transaksi berhasil diperbarui.');
}

    // Menghapus transaksi
    public function destroy($noTransaksi)
{
    $transaksi = MutasiHeader::findOrFail($noTransaksi);

    DB::transaction(function () use ($transaksi) {

        // Menghapus seluruh barang dalam transaksi
        DB::table('TRMUTASIDT')
            ->where('NO_TRANSAKSI', $transaksi->NO_TRANSAKSI)
            ->delete();

        // Menghapus header transaksi
        $transaksi->delete();
    });

    return redirect()
        ->route('transaksi.index')
        ->with('success', 'Transaksi berhasil dihapus beserta seluruh detail barangnya.');
}
}
