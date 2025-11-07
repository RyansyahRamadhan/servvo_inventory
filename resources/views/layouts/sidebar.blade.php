<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @php
                    $role = auth()->user()->role ?? '';
                @endphp

                @if($role === 'administrator')
                    <div class="sb-sidenav-menu-heading">Interface</div>

                   @php
    // helper kecil buat kasih class 'active' di link yang sedang dibuka
    function active($patterns){
        foreach ((array)$patterns as $p) {
            if (request()->routeIs($p)) return 'active';
        }
        return '';
    }
@endphp

<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseInput" aria-expanded="false" aria-controls="collapseInput">
    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
    INPUT
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>

<div class="collapse" id="collapseInput">
    <nav class="sb-sidenav-menu-nested nav">

        <span class="nav-link disabled text-uppercase fw-semibold" style="opacity:.75">Stock</span>

        <a class="nav-link {{ active('barangmasuk.*') }}" href="{{ route('barangmasuk.index') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
            Penerimaan Barang Masuk
        </a>

        <a class="nav-link {{ active('fpb.*') }}" href="{{ route('fpb.index') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
            Form Permintaan Barang
        </a>

        {{-- LPBHP --}}
        <a class="nav-link collapsed {{ active(['lpbhp.index','lpbhp.create']) }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLPBHP" aria-expanded="false" aria-controls="collapseLPBHP">
            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
            LPBHP
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseLPBHP">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link {{ active('lpbhp.index') }}" href="{{ route('lpbhp.index') }}">Daftar LPBHP</a>
                <a class="nav-link {{ active('lpbhp.create') }}" href="{{ route('lpbhp.create') }}">Buat LPBHP Baru</a>
            </nav>
        </div>

        {{-- Move Rak --}}
        <a class="nav-link collapsed {{ active(['moverak.index','moverak.create']) }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMoverak" aria-expanded="false" aria-controls="collapseMoverak">
            <div class="sb-nav-link-icon"><i class="fas fa-exchange-alt"></i></div>
            Move Rak
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseMoverak">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link {{ request()->routeIs('moverak.index') ? 'active' : '' }}"
   href="{{ route('moverak.index') }}">Daftar Move Rak</a>
<a class="nav-link {{ request()->routeIs('moverak.create') ? 'active' : '' }}"
   href="{{ route('moverak.create') }}">Tambah Move Rak</a>

            </nav>
        </div>{{-- Barang Keluar --}}
@php
    $bkActive = request()->routeIs('input.barangkeluar.*');
@endphp

<a class="nav-link {{ $bkActive ? '' : 'collapsed' }}"
   href="#"
   data-bs-toggle="collapse"
   data-bs-target="#collapseBarangKeluar"
   aria-expanded="{{ $bkActive ? 'true' : 'false' }}"
   aria-controls="collapseBarangKeluar">
    <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
    Barang Keluar
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>

<div class="collapse {{ $bkActive ? 'show' : '' }}" id="collapseBarangKeluar">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link {{ request()->routeIs('input.barangkeluar.index') ? 'active' : '' }}"
           href="{{ route('input.barangkeluar.index') }}">
            Daftar Barang Keluar
        </a>
        <a class="nav-link {{ request()->routeIs('input.barangkeluar.create') ? 'active' : '' }}"
           href="{{ route('input.barangkeluar.create') }}">
            Tambah Barang Keluar
        </a>
    </nav>
</div>



        {{-- Penyesuaian --}}
        <a class="nav-link collapsed {{ active(['penyesuaian.index','penyesuaian.create']) }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePenyesuaian" aria-expanded="false" aria-controls="collapsePenyesuaian">
            <div class="sb-nav-link-icon"><i class="fas fa-balance-scale"></i></div>
            Penyesuaian Stok
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapsePenyesuaian">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link {{ active('penyesuaian.index') }}" href="{{ route('penyesuaian.index') }}">Daftar Penyesuaian</a>
                <a class="nav-link {{ active('penyesuaian.create') }}" href="{{ route('penyesuaian.create') }}">Tambah Penyesuaian</a>
            </nav>
        </div>

    </nav>
</div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDaftar" aria-expanded="false">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        DAFTAR
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseDaftar">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('stok.index') }}">Daftar Stok</a>
                            <a class="nav-link" href="{{ route('barang.index') }}">Daftar Barang</a>
                            <a class="nav-link" href="{{ route('formula.index') }}">Daftar Formula</a>
                            <a class="nav-link" href="{{ route('lorong.index') }}">Daftar Lorong</a>
                            <a class="nav-link" href="{{ route('rak.index') }}">Daftar Rak</a>
                            <a class="nav-link" href="{{ route('gudang.index') }}">Daftar Gudang</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMaster" aria-expanded="false">
                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                        MASTER
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseMaster">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{ route('standartpallet.index') }}">Daftar Standar Pallet</a>
                        </nav>
                    </div>

                 <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLaporan"
   aria-expanded="false" aria-controls="collapseLaporan">
    <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
    LAPORAN
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseLaporan" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="{{ route('laporan.stok-per-rak') }}">
            <i class="fas fa-boxes me-2"></i> Stok per Rak
        </a>
        <a class="nav-link" href="{{ route('laporan.stok-per-lorong') }}">
            <i class="fas fa-warehouse me-2"></i> Stok per Lorong
        </a>
        <a class="nav-link" href="#">
            <i class="fas fa-exchange-alt me-2"></i> Transaksi per Rak
        </a>
        <a class="nav-link" href="#">
            <i class="fas fa-history me-2"></i> History Barang
        </a>
    </nav>
</div>


                @elseif($role === 'admin_girn')
                    <div class="sb-sidenav-menu-heading">INPUT</div>
                    <a class="nav-link" href="#">Penerimaan Barang Masuk</a>

                @elseif($role === 'supervisor')
                <div class="sb-sidenav-menu-heading">Daftar</div>
                    <a class="nav-link" href="{{ route('barang.index') }}">Daftar Barang</a>
                    <div class="sb-sidenav-menu-heading">Laporan</div>
                    <a class="nav-link" href="#">Laporan Rak</a>
                      <a class="nav-link" href="{{ route('laporan.barang-per-lorong') }}">Barang per Lorong</a>
      <a class="nav-link" href="{{ route('laporan.stok') }}">Stok</a>
      <a class="nav-link" href="{{ route('laporan.transaksi-per-rak') }}">Transaksi per Rak</a>
      <a class="nav-link" href="{{ route('laporan.history-barang') }}">History Barang</a>
                @endif

            </div>
        </div>
    </nav>
</div>
