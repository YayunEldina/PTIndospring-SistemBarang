<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Transaksi | PT Indospring</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/transaksi.css') }}">
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

        <a href="{{ route('transaksi.index') }}" class="menu active">
            <span class="menu-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
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
               <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M17 3l4 4-4 4"/>
                    <path d="M3 7h18"/>
                    <path d="M7 21l-4-4 4-4"/>
                    <path d="M21 17H3"/>
                </svg>
            </span>
            <span>Data Transaksi Barang</span>
        </a>

       <!-- PROFILE ADMINISTRATOR -->
        <div class="sidebar-profile">
            <div class="profile-avatar">
                A
            </div>

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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M17 3l4 4-4 4"/>
                    <path d="M3 7h18"/>
                    <path d="M7 21l-4-4 4-4"/>
                    <path d="M21 17H3"/>
                </svg>
            </div>

            <div class="page-header-text">
                <p class="breadcrumb">
                    Inventory Management / <span>Data Transaksi</span>
                </p>

                <h1>Dashboard Transaksi Barang</h1>

                <p>
                    Kelola seluruh aktivitas transaksi barang masuk dan keluar.
                </p>
            </div>

            <div class="page-header-art" aria-hidden="true">
                <svg viewBox="0 0 260 130" fill="none">
                    <circle cx="150" cy="70" r="60" fill="#c7d6fb" opacity=".55"/>
                    <rect x="40" y="55" width="62" height="62" rx="4" fill="#e8b27a"/>
                    <rect x="40" y="55" width="62" height="14" rx="3" fill="#f0c493"/>
                    <rect x="64" y="55" width="14" height="22" fill="#fff" opacity=".7"/>
                    <rect x="98" y="75" width="58" height="42" rx="4" fill="#dca468"/>
                    <rect x="98" y="75" width="58" height="12" rx="3" fill="#ecbb85"/>
                    <rect x="170" y="14" width="70" height="100" rx="8" fill="#1e3a8a"/>
                    <rect x="176" y="24" width="58" height="84" rx="4" fill="#fff"/>
                    <rect x="196" y="8" width="20" height="12" rx="4" fill="#3b5bdb"/>
                    <path d="M182 42l4 4 7-8" stroke="#2563eb" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <rect x="198" y="40" width="30" height="5" rx="2.5" fill="#93b4f5"/>
                    <path d="M182 62l4 4 7-8" stroke="#2563eb" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <rect x="198" y="60" width="30" height="5" rx="2.5" fill="#93b4f5"/>
                    <path d="M182 82l4 4 7-8" stroke="#2563eb" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <rect x="198" y="80" width="22" height="5" rx="2.5" fill="#93b4f5"/>
                </svg>
            </div>
        </section>


        <!-- NOTIFICATION -->
        @if(session('success'))
            <div class="alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

    <!-- KOLOM KIRI: DAFTAR TRANSAKSI -->
    <section class="transaction-list">
        <!-- SUMMARY + FILTER -->
        <div class="top-row">

            <!-- FILTER -->
            <section class="filter-card">
                <div class="filter-field">
                <label for="filterTanggal">Tanggal</label>
                <input
                    type="date"
                    id="filterTanggal"
                    class="date-filter"
                >
            </div>
                <div class="filter-field">
                    <label for="filterJenis">Jenis Transaksi</label>
                    <div class="select-wrap">
                        <select id="filterJenis">
                            <option value="">Semua</option>
                            <option value="MASUK">MASUK</option>
                            <option value="KELUAR">KELUAR</option>
                        </select>
                    </div>
                </div>

                <div class="filter-field">
                    <label for="filterKategori">Kategori</label>
                    <div class="select-wrap">
                        <select id="filterKategori">
                            <option value="">Semua</option>
                            @foreach($transaksi->pluck('KATEGORI')->filter()->unique()->sort() as $kategori)
                                <option value="{{ $kategori }}">{{ $kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="filter-actions">
                    <button type="button" class="btn btn-primary" id="btnCari">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="7"/>
                            <path d="M21 21l-4.3-4.3"/>
                        </svg>
                        Cari
                    </button>

                    <button type="button" class="btn btn-outline" id="btnReset">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M3 12a9 9 0 1 0 3-6.7"/>
                            <path d="M3 4v5h5"/>
                        </svg>
                        Reset
                    </button>
                </div>
            </section>


            <!-- SUMMARY -->
            <section class="summary-grid">

                <div class="summary-card">
                    <div class="summary-info">
                        <p>Total Transaksi</p>
                        <h2>{{ $transaksi->count() }}</h2>
                    </div>

                    <div class="summary-icon icon-blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="5" y="3" width="14" height="18" rx="2"/>
                            <path d="M9 8h6M9 12h6M9 16h4"/>
                        </svg>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-info">
                        <p>Barang Masuk</p>
                        <h2>{{ $transaksi->where('JENIS_TRANSAKSI', 'MASUK')->count() }}</h2>
                    </div>

                    <div class="summary-icon icon-green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 3v12"/>
                            <path d="M7 10l5 5 5-5"/>
                            <path d="M4 20h16"/>
                        </svg>
                    </div>
                </div>

                <div class="summary-card">
                    <div class="summary-info">
                        <p>Barang Keluar</p>
                        <h2>{{ $transaksi->where('JENIS_TRANSAKSI', 'KELUAR')->count() }}</h2>
                    </div>

                    <div class="summary-icon icon-orange">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 21V9"/>
                            <path d="M7 14l5-5 5 5"/>
                            <path d="M4 4h16"/>
                        </svg>
                    </div>
                </div>

            </section>
        </div>


       
<!-- TRANSACTION TABLE -->
<section class="table-card">

    <div class="table-heading">
        <div>
            <h3>Daftar Transaksi</h3>
            <p>Informasi seluruh transaksi barang yang tersimpan.</p>
        </div>

        <div class="table-heading-right">
         
            <a
                href="{{ route('transaksi.create') }}"
                class="btn btn-primary btn-lg"
            >
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Tambah Transaksi
            </a>
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th width="55">NO</th>
                    <th>NO TRANSAKSI</th>
                    <th>TANGGAL</th>
                    <th>JENIS TRANSAKSI</th>
                    <th>KATEGORI</th>
                    <th>NAMA BARANG</th>
                    <th width="90">QTY</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $nomor = 1;
                @endphp

                @forelse($transaksi as $item)

                    @forelse($item->detailTransaksi as $detail)

                        <tr
                            data-row
                            data-jenis="{{ $item->JENIS_TRANSAKSI }}"
                            data-tanggal="{{ $item->TANGGAL->format('Y-m-d') }}"
                            data-kategori="{{ $item->KATEGORI }}"
                            data-search="{{ strtolower($item->NO_TRANSAKSI . ' ' . $item->JENIS_TRANSAKSI . ' ' . $item->KATEGORI . ' ' . ($detail->barang->NAMA_BARANG ?? '')) }}"
                        >
                            <td class="row-number">{{ $nomor++ }}</td>

                            <td>
                                <span class="transaction-number">
                                    {{ $item->NO_TRANSAKSI }}
                                </span>
                            </td>

                            <td>{{ $item->TANGGAL->format('d-m-Y') }}</td>

                            <td>
                                @if($item->JENIS_TRANSAKSI == 'MASUK')
                                    <span class="transaction-type type-in">↓ MASUK</span>
                                @else
                                    <span class="transaction-type type-out">↑ KELUAR</span>
                                @endif
                            </td>

                            <td>
                                <span class="category">{{ $item->KATEGORI }}</span>
                            </td>

                            <td>
                                <strong class="detail-item">
                                    {{ $detail->barang->NAMA_BARANG ?? '-' }}
                                </strong>
                            </td>

                            <td class="detail-qty">{{ $detail->QTY }}</td>

                            <td>
                                <div class="action-buttons">

                                    <a
                                        href="{{ route('transaksi.edit', $item->NO_TRANSAKSI) }}"
                                        class="btn btn-edit"
                                        title="Edit transaksi"
                                    >
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M12 20h9"/>
                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/>
                                        </svg>
                                        Edit
                                    </a>

                                    <form
                                    action="{{ route('transaksi.destroy', $item->NO_TRANSAKSI) }}"
                                    method="POST"
                                    class="form-hapus-transaksi"
                                    data-nomor="{{ $item->NO_TRANSAKSI }}"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="button"
                                        class="btn btn-delete btn-buka-popup"
                                        title="Hapus transaksi"
                                    >
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" aria-hidden="true">
                                            <path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6M10 11v6M14 11v6"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr
                            data-row
                            data-jenis="{{ $item->JENIS_TRANSAKSI }}"
                            data-tanggal="{{ $item->TANGGAL->format('Y-m-d') }}"
                            data-kategori="{{ $item->KATEGORI }}"
                            data-search="{{ strtolower($item->NO_TRANSAKSI . ' ' . $item->JENIS_TRANSAKSI . ' ' . $item->KATEGORI) }}"
                        >
                            <td class="row-number">{{ $nomor++ }}</td>
                            <td>
                                <span class="transaction-number">{{ $item->NO_TRANSAKSI }}</span>
                            </td>
                            <td>{{ $item->TANGGAL->format('d-m-Y') }}</td>
                            <td>{{ $item->JENIS_TRANSAKSI }}</td>
                            <td>{{ $item->KATEGORI }}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>

                    @endforelse

                @empty

                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M21 8l-9-5-9 5v8l9 5 9-5z"/>
                                        <path d="M3 8l9 5 9-5"/>
                                        <path d="M12 13v8"/>
                                    </svg>
                                </div>

                                <h3>Belum Ada Transaksi</h3>
                                <p>Silakan tambahkan transaksi barang pertama Anda.</p>

                                <br>

                                <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-lg">
                                    ＋ Tambah Transaksi
                                </a>
                            </div>
                        </td>
                    </tr>

                @endforelse

                <!-- DATA TIDAK DITEMUKAN -->
                <tr id="noResult" style="display:none">
                    <td colspan="8">
                        <div class="empty-state">
                            <h3>Data tidak ditemukan</h3>
                            <p>Coba ubah filter pencarian.</p>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="pagination-container" id="paginationContainer">

        <div class="pagination-info" id="paginationInfo">
            Menampilkan 0 data
        </div>

        <div class="pagination-buttons">

            <button type="button" class="page-btn" id="prevPage">
                Previous
            </button>

            <div id="pageNumbers" class="page-numbers"></div>

            <button type="button" class="page-btn" id="nextPage">
                Next
            </button>

        </div>
    </div>

</section>

<!-- FOOTER -->
<footer class="footer">
    © {{ date('Y') }} PT Indospring. Inventory Management System.
</footer>

<!-- POPUP KONFIRMASI HAPUS -->
<div class="delete-modal" id="deleteModal">

    <div class="delete-modal-content">

        <div class="delete-modal-icon">
            <svg viewBox="0 0 24 24" fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M3 6h18"/>
                <path d="M8 6V4h8v2"/>
                <path d="M19 6l-1 14H6L5 6"/>
                <path d="M10 11v6M14 11v6"/>
            </svg>
        </div>

        <h3>Hapus Transaksi?</h3>

        <p>
            Apakah kamu yakin ingin menghapus transaksi
            <strong id="nomorTransaksiHapus"></strong>?
        </p>

        <p class="delete-modal-warning">
            Seluruh detail barang pada transaksi ini juga akan dihapus.
        </p>

        <div class="delete-modal-actions">

            <button type="button" id="btnBatalHapus" class="btn-batal-hapus">
                Batal
            </button>

            <button type="button" id="btnKonfirmasiHapus" class="btn-konfirmasi-hapus">
                Ya, Hapus
            </button>

        </div>

    </div>

</div>
    
<!-- JAVASCRIPT -->
<script>
    
(function () {

    // ==================================
    // ELEMENT FILTER DAN PAGINATION
    // ==================================

    var rows = Array.from(document.querySelectorAll('tr[data-row]'));

    var jenis = document.getElementById('filterJenis');
    var tanggal = document.getElementById('filterTanggal');
    var kategori = document.getElementById('filterKategori');

    var btnCari = document.getElementById('btnCari');
    var btnReset = document.getElementById('btnReset');

    var noResult = document.getElementById('noResult');

    var paginationContainer = document.getElementById('paginationContainer');
    var paginationInfo = document.getElementById('paginationInfo');
    var pageNumbers = document.getElementById('pageNumbers');

    var prevPage = document.getElementById('prevPage');
    var nextPage = document.getElementById('nextPage');

    var dataPerPage = 5;
    var currentPage = 1;
    var filteredRows = rows;

    // ==================================
    // FILTER DATA
    // ==================================

    function applyFilter() {

        filteredRows = rows.filter(function (row) {

            var cocokJenis =
                !jenis.value ||
                row.dataset.jenis === jenis.value;

            var cocokTanggal =
                !tanggal.value ||
                row.dataset.tanggal === tanggal.value;

            var cocokKategori =
                !kategori.value ||
                row.dataset.kategori === kategori.value;

            return cocokJenis && cocokTanggal && cocokKategori;

        });

        currentPage = 1;
        renderPage();
    }

    // ==================================
    // RENDER PAGINATION
    // ==================================

    function renderPage() {

        var totalData = filteredRows.length;
        var totalPages = Math.ceil(totalData / dataPerPage);

        if (totalPages === 0) {
            totalPages = 1;
        }

        if (currentPage > totalPages) {
            currentPage = totalPages;
        }

        var startIndex = (currentPage - 1) * dataPerPage;
        var endIndex = Math.min(startIndex + dataPerPage, totalData);

        rows.forEach(function (row) {
            row.style.display = 'none';
        });

        var visibleRows = filteredRows.slice(startIndex, endIndex);

        visibleRows.forEach(function (row, index) {

            row.style.display = '';
            row.cells[0].textContent = startIndex + index + 1;

        });

        if (noResult) {
            noResult.style.display = totalData === 0 ? '' : 'none';
        }

        if (totalData > 0) {

            paginationInfo.textContent =
                'Menampilkan ' +
                (startIndex + 1) +
                '–' +
                endIndex +
                ' dari ' +
                totalData +
                ' data | Halaman ' +
                currentPage +
                ' dari ' +
                totalPages;

        } else {

            paginationInfo.textContent = 'Menampilkan 0 data';

        }

        prevPage.disabled = currentPage === 1 || totalData === 0;
        nextPage.disabled = currentPage === totalPages || totalData === 0;

        pageNumbers.innerHTML = '';

        for (var i = 1; i <= totalPages; i++) {

            var button = document.createElement('button');

            button.type = 'button';
            button.textContent = i;
            button.className = 'page-btn';

            if (i === currentPage) {
                button.classList.add('active');
            }

            button.addEventListener('click', function () {
                currentPage = parseInt(this.textContent);
                renderPage();
            });

            pageNumbers.appendChild(button);
        }

        paginationContainer.style.display =
            totalData > 0 ? 'flex' : 'none';
    }

    // ==================================
    // TOMBOL PAGINATION
    // ==================================

    prevPage.addEventListener('click', function () {

        if (currentPage > 1) {
            currentPage--;
            renderPage();
        }

    });

    nextPage.addEventListener('click', function () {

        var totalPages = Math.ceil(filteredRows.length / dataPerPage);

        if (currentPage < totalPages) {
            currentPage++;
            renderPage();
        }

    });

    // ==================================
    // EVENT FILTER
    // ==================================

    if (jenis) {
        jenis.addEventListener('change', applyFilter);
    }

    if (tanggal) {
        tanggal.addEventListener('change', applyFilter);
    }

    if (kategori) {
        kategori.addEventListener('change', applyFilter);
    }

    if (btnCari) {
        btnCari.addEventListener('click', applyFilter);
    }

    if (btnReset) {

        btnReset.addEventListener('click', function () {

            jenis.value = '';
            tanggal.value = '';
            kategori.value = '';

            applyFilter();

        });

    }

   // ==================================
// POPUP KONFIRMASI HAPUS
// ==================================

var deleteModal = document.getElementById('deleteModal');
var nomorTransaksiHapus = document.getElementById('nomorTransaksiHapus');
var btnBatalHapus = document.getElementById('btnBatalHapus');
var btnKonfirmasiHapus = document.getElementById('btnKonfirmasiHapus');

var formHapusAktif = null;

// Membuka popup
document.querySelectorAll('.btn-buka-popup').forEach(function (button) {

    button.addEventListener('click', function () {

        formHapusAktif = this.closest('.form-hapus-transaksi');

        if (!formHapusAktif || !deleteModal || !nomorTransaksiHapus) {
            return;
        }

        var nomor = formHapusAktif.dataset.nomor;

        nomorTransaksiHapus.textContent = nomor;

        deleteModal.classList.add('show');

    });

});

// Menutup popup
function tutupPopupHapus() {

    if (deleteModal) {
        deleteModal.classList.remove('show');
    }

    formHapusAktif = null;

}

// Tombol batal
if (btnBatalHapus) {

    btnBatalHapus.addEventListener('click', function () {
        tutupPopupHapus();
    });

}

// Klik area luar popup
if (deleteModal) {

    deleteModal.addEventListener('click', function (event) {

        if (event.target === deleteModal) {
            tutupPopupHapus();
        }

    });

}

// Tombol konfirmasi hapus
if (btnKonfirmasiHapus) {

    btnKonfirmasiHapus.addEventListener('click', function () {

        if (formHapusAktif) {
            formHapusAktif.submit();
        }

    });

}

// Tutup popup menggunakan tombol Escape
document.addEventListener('keydown', function (event) {

    if (
        event.key === 'Escape' &&
        deleteModal &&
        deleteModal.classList.contains('show')
    ) {
        tutupPopupHapus();
    }

});

})();
</script>

</body>
</html>