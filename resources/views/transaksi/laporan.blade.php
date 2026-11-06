
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Stok Barang | PT Indospring</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/transaksi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="brand">
            <img
                src="{{ asset('images/logo-pt-indospring-tbk.jpeg') }}"
                alt="Logo PT Indospring Tbk"
                class="brand-logo"
            >

            <div class="brand-text">
                <h3>INDOSPRING</h3>
                <small>Inventory Management</small>
            </div>
        </div>

        <p class="menu-title">MENU UTAMA</p>

        <a href="{{ route('transaksi.index') }}" class="menu">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3l4 4-4 4"/>
                    <path d="M3 7h18"/>
                    <path d="M7 21l-4-4 4-4"/>
                    <path d="M21 17H3"/>
                </svg>
            </span>
            <span>Dashboard Transaksi</span>
        </a>

        <p class="menu-title">LAINNYA</p>

        <a href="{{ route('transaksi.create') }}" class="menu">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3l4 4-4 4"/>
                    <path d="M3 7h18"/>
                    <path d="M7 21l-4-4 4-4"/>
                    <path d="M21 17H3"/>
                </svg>
            </span>
            <span>Data Transaksi Barang</span>
        </a>

        <a href="{{ route('transaksi.laporan') }}" class="menu active">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19V5"/>
                    <path d="M4 19h17"/>
                    <path d="M8 15v-4"/>
                    <path d="M13 15V7"/>
                    <path d="M18 15V3"/>
                </svg>
            </span>
            <span>Laporan Stok Barang</span>
        </a>

        <!-- PROFILE ADMINISTRATOR -->
        <div class="sidebar-profile">
            <div class="profile-avatar">A</div>

            <div class="profile-info">
                <strong>Administrator</strong>
                <small>Admin Inventory</small>
            </div>

            <div class="profile-status" title="Aktif"></div>
        </div>

        <div class="sidebar-bottom">
            © {{ date('Y') }} PT Indospring
        </div>

    </aside>


    <!-- MAIN -->
    <main class="main">

        <!-- PAGE HEADER -->
        <section class="page-header">

            <div class="page-header-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19V5"/>
                    <path d="M4 19h17"/>
                    <path d="M8 15v-4"/>
                    <path d="M13 15V7"/>
                    <path d="M18 15V3"/>
                </svg>
            </div>

            <div class="page-header-text">
                <p class="breadcrumb">
                    Inventory Management / <span>Laporan Stok Barang</span>
                </p>

                <h1>Laporan Stok Barang</h1>

                <p>
                    Informasi stok dan transaksi barang berdasarkan periode.
                </p>
            </div>

        </section>


        <!-- PERIODE LAPORAN -->
        <section class="report-section">

            <div class="report-heading">
                <h3>Periode Laporan</h3>

                <p>
                    Data transaksi barang dari tanggal
                    {{ \Carbon\Carbon::parse($tanggalAwal)->format('d-m-Y') }}
                    sampai
                    {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d-m-Y') }}.
                </p>

                <span class="report-period">
                    Januari – Februari 2021
                </span>
            </div>

            <div class="report-actions">

                <a href="{{ route('transaksi.index') }}" class="btn btn-primary">
                    Kembali ke Dashboard
                </a>

            </div>

        </section>


        <!-- LAPORAN 3.1 -->
        <section class="report-section">

            <div class="report-heading">
                <h3>3.1 Laporan Stok Barang</h3>

                <p>
                    Menampilkan jumlah transaksi masuk, transaksi keluar,
                    dan stok akhir setiap barang.
                </p>
            </div>

            <div class="report-table-wrapper">

                <table class="report-table">

                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>KODE BARANG</th>
                            <th>NAMA BARANG</th>
                            <th>SATUAN</th>
                            <th>KATEGORI</th>
                            <th class="number">TRANS. MASUK</th>
                            <th class="number">TRANS. KELUAR</th>
                            <th class="number">STOK AKHIR</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($laporanBarang as $index => $item)

                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->KODE_BARANG }}</td>
                                <td>{{ $item->NAMA_BARANG }}</td>
                                <td>{{ $item->SATUAN }}</td>

                                <td>
                                    <span class="report-category">
                                        {{ $item->KATEGORI }}
                                    </span>
                                </td>

                                <td class="number">{{ $item->TRANS_MASUK }}</td>
                                <td class="number">{{ $item->TRANS_KELUAR }}</td>
                                <td class="number stock-value">{{ $item->STOK_AKHIR }}</td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="report-empty">
                                    Belum ada data stok barang.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>


        <!-- LAPORAN 3.2 -->
        <section class="report-section">

            <div class="report-heading">
                <h3>3.2 Laporan Stok Berdasarkan Kategori dan Satuan</h3>

                <p>
                    Menampilkan total transaksi dan stok akhir berdasarkan
                    kelompok kategori serta satuan barang.
                </p>
            </div>

            <div class="report-table-wrapper">

                <table class="report-table">

                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>KATEGORI</th>
                            <th>SATUAN</th>
                            <th class="number">TRANS. MASUK</th>
                            <th class="number">TRANS. KELUAR</th>
                            <th class="number">STOK AKHIR</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($laporanKelompok as $index => $item)

                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <span class="report-category">
                                        {{ $item->KATEGORI }}
                                    </span>
                                </td>

                                <td>{{ $item->SATUAN }}</td>
                                <td class="number">{{ $item->TRANS_MASUK }}</td>
                                <td class="number">{{ $item->TRANS_KELUAR }}</td>
                                <td class="number stock-value">{{ $item->STOK_AKHIR }}</td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="report-empty">
                                    Belum ada data kelompok stok.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>


        <!-- LAPORAN 3.3 -->
        <section class="report-section">

            <div class="report-heading">
                <h3>3.3 Barang dengan Transaksi Keluar Tertinggi</h3>

                <p>
                    Menampilkan barang dengan jumlah transaksi keluar
                    tertinggi pada setiap kategori dan satuan.
                </p>
            </div>

            <div class="report-table-wrapper">

                <table class="report-table">

                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>KATEGORI</th>
                            <th>SATUAN</th>
                            <th>KODE BARANG</th>
                            <th>NAMA BARANG</th>
                            <th class="number">TRANS. KELUAR</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($laporanTertinggi as $index => $item)

                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <span class="report-category">
                                        {{ $item->KATEGORI }}
                                    </span>
                                </td>

                                <td>{{ $item->SATUAN }}</td>
                                <td>{{ $item->KODE_BARANG }}</td>
                                <td>{{ $item->NAMA_BARANG }}</td>

                                <td class="number stock-value">
                                    {{ $item->TRANS_KELUAR }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="report-empty">
                                    Belum ada transaksi keluar pada periode ini.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>


        <!-- FOOTER -->
        <footer class="footer">
            © {{ date('Y') }} PT Indospring. Inventory Management System.
        </footer>

    </main>

</body>
</html>
