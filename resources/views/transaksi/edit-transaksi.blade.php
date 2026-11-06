```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Transaksi Barang | PT Indospring</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

   
    <link rel="stylesheet" href="{{ asset('css/transaksi.css') }}?v=2">
    <link rel="stylesheet" href="{{ asset('css/data-transaksi.css') }}?v=2">

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

        <a href="{{ route('transaksi.create') }}" class="menu active">
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
                    <path d="M17 3l4 4-4 4"/>
                    <path d="M3 7h18"/>
                    <path d="M7 21l-4-4 4-4"/>
                    <path d="M21 17H3"/>
                </svg>
            </div>

            <div class="page-header-text">
                <p class="breadcrumb">
                    Inventory Management / <span>Edit Transaksi</span>
                </p>

                <h1>Edit Transaksi Barang</h1>

                <p>
                    Perbarui data transaksi barang masuk dan keluar.
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

        @if($errors->any())
            <div class="alert-success" style="background:#fee2e2; color:#991b1b;">
                <strong>Terjadi kesalahan:</strong>

                <ul style="margin-left:20px; margin-top:8px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- FORM EDIT TRANSAKSI -->
        <section class="transaction-list">

            <form
                action="{{ route('transaksi.update', $transaksi->NO_TRANSAKSI) }}"
                method="POST"
                id="formTransaksi"
            >
                @csrf
                @method('PUT')

                <div class="transaction-container">

                    <!-- FORM HEADER -->
                    <div class="transaction-header-fields">

                        <div class="filter-field">
                            <label for="no_transaksi">No. Transaksi</label>

                            <input
                                type="text"
                                id="no_transaksi"
                                value="{{ $transaksi->NO_TRANSAKSI }}"
                                readonly
                            >
                        </div>

                        <div class="filter-field">
                            <label for="tanggal">Tanggal</label>

                            <input
                                type="date"
                                id="tanggal"
                                name="TANGGAL"
                                value="{{ old('TANGGAL', $transaksi->TANGGAL->format('Y-m-d')) }}"
                                required
                            >
                        </div>

                        <div class="filter-field">
                            <label for="jenis_transaksi">Jenis Transaksi</label>

                            <select
                                id="jenis_transaksi"
                                name="JENIS_TRANSAKSI"
                                required
                            >
                                <option value="">Pilih Jenis Transaksi</option>

                                <option value="MASUK"
                                    {{ old('JENIS_TRANSAKSI', $transaksi->JENIS_TRANSAKSI) == 'MASUK' ? 'selected' : '' }}>
                                    MASUK
                                </option>

                                <option value="KELUAR"
                                    {{ old('JENIS_TRANSAKSI', $transaksi->JENIS_TRANSAKSI) == 'KELUAR' ? 'selected' : '' }}>
                                    KELUAR
                                </option>
                            </select>
                        </div>

                        <div class="filter-field">
                            <label for="kategori">Kategori</label>

                            <select
                                id="kategori"
                                name="KATEGORI"
                                required
                            >
                                <option value="">Pilih Kategori</option>

                                <option value="RAWMAT"
                                    {{ old('KATEGORI', $transaksi->KATEGORI) == 'RAWMAT' ? 'selected' : '' }}>
                                    RAWMAT
                                </option>

                                <option value="SUBMAT"
                                    {{ old('KATEGORI', $transaksi->KATEGORI) == 'SUBMAT' ? 'selected' : '' }}>
                                    SUBMAT
                                </option>
                            </select>
                        </div>

                    </div>


                    <!-- TABEL DETAIL BARANG -->
                    <div class="transaction-detail">

                        <div class="detail-heading">

                            <h3>Detail Barang Transaksi</h3>

                            <button
                                type="button"
                                class="btn-tambah-item"
                                id="btnTambahItem"
                            >
                                <svg viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round">
                                    <path d="M12 5v14"/>
                                    <path d="M5 12h14"/>
                                </svg>

                                Tambah Item
                            </button>

                        </div>

                        <div class="table-wrapper">

                            <table>
                                <thead>
                                    <tr>
                                        <th width="45">#</th>
                                        <th width="135">KODE BARANG</th>
                                        <th>NAMA BARANG</th>
                                        <th width="85">SATUAN</th>
                                        <th width="100">QTY</th>
                                        <th width="80">AKSI</th>
                                    </tr>
                                </thead>

                                <tbody id="detailBarang">

                                    @php
                                        $detailTransaksi = old(
                                            'detail',
                                            $transaksi->detailTransaksi->map(function ($detail) {
                                                return [
                                                    'KODE_BARANG' => $detail->KODE_BARANG,
                                                    'QTY' => $detail->QTY,
                                                ];
                                            })->toArray()
                                        );

                                        if (empty($detailTransaksi)) {
                                            $detailTransaksi = [[]];
                                        }
                                    @endphp

                                    @foreach($detailTransaksi as $index => $detail)

                                        @php
                                            $barangTerpilih = $barang->firstWhere(
                                                'KODE_BARANG',
                                                $detail['KODE_BARANG'] ?? ''
                                            );
                                        @endphp

                                        <tr class="baris-barang">

                                            <td class="nomor-item">
                                                {{ $index + 1 }}
                                            </td>

                                            <td>
                                                <select
                                                    name="detail[{{ $index }}][KODE_BARANG]"
                                                    class="pilih-barang"
                                                    required
                                                >
                                                    <option value="">Pilih Barang</option>

                                                    @foreach($barang as $item)
                                                        <option
                                                            value="{{ $item->KODE_BARANG }}"
                                                            data-nama="{{ $item->NAMA_BARANG }}"
                                                            data-satuan="{{ $item->SATUAN }}"
                                                            {{ ($detail['KODE_BARANG'] ?? '') == $item->KODE_BARANG ? 'selected' : '' }}
                                                        >
                                                            {{ $item->KODE_BARANG }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </td>

                                            <td class="nama-barang">
                                                {{ $barangTerpilih->NAMA_BARANG ?? '-' }}
                                            </td>

                                            <td class="satuan-barang">
                                                {{ $barangTerpilih->SATUAN ?? '-' }}
                                            </td>

                                            <td>
                                                <input
                                                    type="number"
                                                    name="detail[{{ $index }}][QTY]"
                                                    class="qty-barang"
                                                    min="1"
                                                    step="1"
                                                    placeholder="QTY"
                                                    value="{{ $detail['QTY'] ?? '' }}"
                                                    required
                                                >
                                            </td>

                                            <td>
                                                <button
                                                    type="button"
                                                    class="btn-hapus-item"
                                                >
                                                    Hapus
                                                </button>
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>


                <!-- TOMBOL AKSI -->
                <div class="transaction-actions">

                    <button
                        type="reset"
                        class="btn-reset"
                        id="btnReset"
                    >
                        Reset
                    </button>

                    <button
                        type="submit"
                        class="btn-simpan"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </section>


        <!-- FOOTER -->
        <footer class="footer">
            © {{ date('Y') }} PT Indospring. Inventory Management System.
        </footer>

    </main>


    <!-- TEMPLATE BARIS BARANG -->
    <template id="templateBarang">

        <tr class="baris-barang">

            <td class="nomor-item"></td>

            <td>
                <select class="pilih-barang" required>
                    <option value="">Pilih Barang</option>

                    @foreach($barang as $item)
                        <option
                            value="{{ $item->KODE_BARANG }}"
                            data-nama="{{ $item->NAMA_BARANG }}"
                            data-satuan="{{ $item->SATUAN }}"
                        >
                            {{ $item->KODE_BARANG }}
                        </option>
                    @endforeach

                </select>
            </td>

            <td class="nama-barang">-</td>

            <td class="satuan-barang">-</td>

            <td>
                <input
                    type="number"
                    class="qty-barang"
                    min="1"
                    step="1"
                    placeholder="QTY"
                    required
                >
            </td>

            <td>
                <button
                    type="button"
                    class="btn-hapus-item"
                >
                    Hapus
                </button>
            </td>

        </tr>

    </template>


    <!-- JAVASCRIPT DETAIL BARANG -->
    <script>
        const detailBarang = document.getElementById('detailBarang');
        const btnTambahItem = document.getElementById('btnTambahItem');
        const templateBarang = document.getElementById('templateBarang');
        const formTransaksi = document.getElementById('formTransaksi');
        const btnReset = document.getElementById('btnReset');


        // Memperbarui nomor dan nama input setiap baris
        function perbaruiBaris() {

            const semuaBaris = detailBarang.querySelectorAll('.baris-barang');

            semuaBaris.forEach((baris, index) => {

                baris.querySelector('.nomor-item').textContent = index + 1;

                const pilihBarang = baris.querySelector('.pilih-barang');
                pilihBarang.name = `detail[${index}][KODE_BARANG]`;

                const qty = baris.querySelector('.qty-barang');
                qty.name = `detail[${index}][QTY]`;

            });

        }


        // Menambahkan baris barang baru
        btnTambahItem.addEventListener('click', function () {

            const barisBaru = templateBarang.content.cloneNode(true);

            detailBarang.appendChild(barisBaru);

            perbaruiBaris();

        });


        // Ketika kode barang dipilih
        detailBarang.addEventListener('change', function (event) {

            if (event.target.classList.contains('pilih-barang')) {

                const select = event.target;
                const baris = select.closest('.baris-barang');

                const pilihan = select.options[select.selectedIndex];

                const nama = pilihan.dataset.nama || '-';
                const satuan = pilihan.dataset.satuan || '-';

                baris.querySelector('.nama-barang').textContent = nama;
                baris.querySelector('.satuan-barang').textContent = satuan;

                cekBarangDuplikat();

            }

        });


        // Menghapus baris barang
        detailBarang.addEventListener('click', function (event) {

            if (event.target.classList.contains('btn-hapus-item')) {

                const baris = event.target.closest('.baris-barang');

                const semuaBaris = detailBarang.querySelectorAll('.baris-barang');

                if (semuaBaris.length > 1) {

                    baris.remove();

                } else {

                    baris.querySelector('.pilih-barang').value = '';
                    baris.querySelector('.qty-barang').value = '';
                    baris.querySelector('.nama-barang').textContent = '-';
                    baris.querySelector('.satuan-barang').textContent = '-';

                }

                perbaruiBaris();
                cekBarangDuplikat();

            }

        });


        // Mencegah barang yang sama dipilih dua kali
        function cekBarangDuplikat() {

            const semuaSelect = detailBarang.querySelectorAll('.pilih-barang');
            const barangDipilih = [];

            semuaSelect.forEach(select => {

                if (select.value !== '') {

                    if (barangDipilih.includes(select.value)) {

                        select.setCustomValidity('Barang ini sudah ditambahkan.');

                    } else {

                        select.setCustomValidity('');
                        barangDipilih.push(select.value);

                    }

                } else {

                    select.setCustomValidity('');

                }

            });

        }


        // Validasi sebelum menyimpan
        formTransaksi.addEventListener('submit', function (event) {

            perbaruiBaris();
            cekBarangDuplikat();

            const semuaBaris = detailBarang.querySelectorAll('.baris-barang');

            if (semuaBaris.length === 0) {

                event.preventDefault();

                alert('Tambahkan minimal satu barang ke transaksi.');

                return;

            }

            let barangTidakLengkap = false;

            semuaBaris.forEach(baris => {

                const kode = baris.querySelector('.pilih-barang').value;
                const qty = baris.querySelector('.qty-barang').value;

                if (!kode || !qty || Number(qty) < 1) {
                    barangTidakLengkap = true;
                }

            });

            if (barangTidakLengkap) {

                event.preventDefault();

                alert('Silakan pilih barang dan isi QTY minimal 1 pada setiap baris.');

            }

        });


        // Reset mengembalikan form ke data awal dari database
        btnReset.addEventListener('click', function () {

            setTimeout(function () {
                window.location.reload();
            }, 0);

        });


        // Inisialisasi saat halaman pertama kali dibuka
        perbaruiBaris();
        cekBarangDuplikat();

    </script>

</body>
</html>
```