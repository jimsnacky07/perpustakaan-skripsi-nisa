<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="#" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
    class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">STREAM</span>
    </a> --}}

    <!-- Sidebar -->
    @if (Auth()->user()->role == 'admin')
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/14.png') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block">{{ Auth()->user()->name }} |
                    {{ Str::upper(Auth()->user()->role) }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link  {{ Route::is('user') || Route::is('jenis-buku') ? 'active open' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Master
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user') }}" class="nav-link {{ Route::is('user') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Data User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jenis-buku') }}"
                                class="nav-link {{ Route::is('jenis-buku') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Kategori Buku
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('buku-hilang') }}"
                                class="nav-link {{ Route::is('buku-hilang') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Buku Hilang
                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rak-buku') }}"
                                class="nav-link {{ Route::is('rak-buku') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Rak Buku
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('buku.index') }}"
                                class="nav-link {{ Route::is('buku.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Data Buku
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('grafik') }}"
                                class="nav-link {{ Route::is('grafik.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    Grafik Statistik
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('anggota.index') }}"
                                class="nav-link {{ Route::is('anggota.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Data Anggota
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bukurusak.index') }}"
                                class="nav-link {{ Route::is('bukurusak.*') ? 'active' : '' }}"
                                target="_self">
                                <i class="nav-icon fas fa-book-dead"></i>
                                <p>
                                    Data Buku Rusak
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#"
                        class="nav-link  {{ Route::is('peminjaman*') || Route::is('pengembalian*') ? 'active open' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Transaksi Buku
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('peminjaman') }}"
                                class="nav-link {{ Route::is('peminjaman*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Data Peminjaman
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pengembalian') }}"
                                class="nav-link {{ Route::is('pengembalian*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Data Pengembalian Buku
                                </p>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link  {{ Route::is('laporan.kategori-buku') || Route::is('laporan.rak-buku') ? 'active open' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Laporan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('laporan.kategori-buku') }}"
                                class="nav-link {{ Route::is('laporan.kategori-buku') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Laporan Kategori Buku
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('laporan.rak-buku') }}"
                                class="nav-link {{ Route::is('laporan.rak-buku') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Laporan Rak Buku
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.buku-hilang') }}"
                                class="nav-link {{ Route::is('laporan.buku-hilang') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Laporan Buku Hilang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.anggota') }}"
                                class="nav-link {{ Route::is('laporan.anggota') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Laporan Data Anggota
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.buku') }}"
                                class="nav-link {{ Route::is('laporan.buku') ? 'active' : '' }}" target="_blank">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Laporan Data Buku
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.riwayat-peminjaman') }}"
                                class="nav-link {{ Route::is('laporan.riwayat-peminjaman') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    <!-- Grafik -->
                                    <!-- </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('laporan.riwayat-peminjaman') }}"
                                    class="nav-link {{ Route::is('laporan.riwayat-peminjaman') ? 'active' : '' }}"
                                    target="_blank">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p> -->
                                    Laporan Riwayat Peminjaman Buku
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.buku_masuk') }}"
                                class="nav-link {{ Route::is('laporan.buku_masuk') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Laporan Buku Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.buku_rusak') }}"
                                class="nav-link {{ Route::is('laporan.buku_rusak') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-book-dead"></i>
                                <p>Laporan Buku Rusak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.buku_hilang') }}"
                                class="nav-link {{ Route::is('laporan.buku_hilang') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-book-medical"></i>
                                <p>Laporan Buku Hilang</p>
                            </a>
                        </li>


                    </ul>
                </li>


                {{-- <li class="nav-item">
                    <a href="{{ route('user') }}" class="nav-link {{ Route::is('user') ? 'active' : '' }}">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                    Data User
                </p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('jenis-buku') }}"
                        class="nav-link {{ Route::is('jenis-buku') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Jenis Buku
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rak-buku') }}" class="nav-link {{ Route::is('rak-buku') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Rak Buku
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('buku.index') }}" class="nav-link {{ Route::is('buku.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Data Buku
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('anggota.index') }}"
                        class="nav-link {{ Route::is('anggota.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Data Anggota
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('peminjaman') }}"
                        class="nav-link {{ Route::is('peminjaman*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Data Peminjaman
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pengembalian') }}"
                        class="nav-link {{ Route::is('pengembalian*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Data Pengembalian Buku
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('laporan.kategori-buku') }}"
                        class="nav-link {{ Route::is('laporan.kategori-buku') ? 'active' : '' }}" target="_blank">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Laporan Kategori Buku
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.rak-buku') }}"
                        class="nav-link {{ Route::is('laporan.rak-buku') ? 'active' : '' }}" target="_blank">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Laporan Rak Buku
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.anggota') }}"
                        class="nav-link {{ Route::is('laporan.anggota') ? 'active' : '' }}" target="_blank">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Laporan Data Anggota
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.buku') }}"
                        class="nav-link {{ Route::is('laporan.buku') ? 'active' : '' }}" target="_blank">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Laporan Data Buku
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.riwayat-peminjaman') }}"
                        class="nav-link {{ Route::is('laporan.riwayat-peminjaman') ? 'active' : '' }}"
                        target="_blank">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Laporan Riwayat Peminjaman Buku
                        </p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-arrow-left"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    @endif

    @if (Auth()->user()->role == 'pimpinan')
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block">{{ Auth()->user()->name }} |
                    {{ Str::upper(Auth()->user()->role) }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link  {{ Route::is('peminjaman*') || Route::is('pengembalian*') ? 'active open' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Transaksi Buku
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('peminjaman') }}"
                                class="nav-link {{ Route::is('peminjaman*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Data Peminjaman
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pengembalian') }}"
                                class="nav-link {{ Route::is('pengembalian*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Data Pengembalian Buku
                                </p>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link  {{ Route::is('laporan.kategori-buku') || Route::is('laporan.rak-buku') ? 'active open' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Laporan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('laporan.kategori-buku') }}"
                                class="nav-link {{ Route::is('laporan.kategori-buku') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Laporan Kategori Buku
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.rak-buku') }}"
                                class="nav-link {{ Route::is('laporan.rak-buku') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Laporan Rak Buku
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.anggota') }}"
                                class="nav-link {{ Route::is('laporan.anggota') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Laporan Data Anggota
                                </p>
                            </a>
                            <p>
                        <li class="nav-item">
                            <a href="{{ route('laporan.bukurusak') }}"
                                class="nav-link {{ Route::is('laporan.bukuhilang') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Laporan Buku Hilang
                                </p>


                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.buku') }}"
                                class="nav-link {{ Route::is('laporan.buku') ? 'active' : '' }}" target="_blank">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Laporan Data Buku
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.riwayat-peminjaman') }}"
                                class="nav-link {{ Route::is('laporan.riwayat-peminjaman') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Laporan Riwayat Peminjaman Buku
                                </p>
                            </a>
                        </li>


                    </ul>
                </li>




                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-arrow-left"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    @endif

    @if (Auth()->user()->role == 'anggota')
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            {{-- <div class="image">
                    <img src="{{ Storage::url('public/foto/' . auth()->user()->anggota->foto) }}" alt="User Image"
            class="img-circle elevation-2">
        </div> --}}

        <div class="info">
            <a href="#" class="d-block">{{ Auth()->user()->anggota->nama ?? auth()->user()->name }}
                |
                {{ Str::upper(Auth()->user()->role) }}
            </a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('dashboard-anggota') }}"
                    class="nav-link {{ Route::is('dashboard-anggota') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('daftarbuku.index') }}"
                    class="nav-link {{ Route::is('daftarbuku.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                        Daftar Buku
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('riwayat-pinjam-buku.index') }}"
                    class="nav-link {{ Route::is('riwayat-pinjam-buku.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                        Riwayat Pinjam Buku
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('riwayat-pinjam-buku.riwayat-pengembalian-buku') }}"
                    class="nav-link {{ Route::is('riwayat-pinjam-buku.riwayat-pengembalian-buku') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                        Riwayat Pengembalian Buku
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="nav-icon fas fa-arrow-left"></i>
                    <p>
                        Keluar
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    @endif

    <!-- /.sidebar -->
</aside>