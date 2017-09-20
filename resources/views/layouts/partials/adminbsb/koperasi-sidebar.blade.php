<router-link tag="li" to="/my">
    <a>
        <i class="material-icons">store</i>
        <span>Koperasi Saya</span>
    </a>
</router-link>
<li class="header">NAVIGASI UTAMA</li>
<li>
    <a class="menu-toggle">
        <i class="material-icons">archive</i>
        <span>Master</span>
    </a>
    <ul class="ml-menu">
        <router-link tag="li" to="/master-kategori">
            <a>
                <i class="material-icons">shopping_cart</i>
                <span>Kategori Barang</span>
            </a>
        </router-link>
        <router-link tag="li" to="/master-barang">
            <a>
                <i class="material-icons">work</i>
                <span>Barang</span>
            </a>
        </router-link>
    </ul>
</li>
<router-link tag="li" to="/stok">
    <a>
        <i class="material-icons">list</i>
        <span>Manajemen Stok</span>
    </a>
</router-link>
<router-link tag="li" to="/transaksi">
    <a>
        <i class="material-icons">receipt</i>
        <span>Transaksi Belanja</span>
    </a>
</router-link>
<li>
    <a href="{{ url('koperasi/transaksi/cetak') }}" target="_blank">
        <i class="material-icons">print</i>
        <span>Cetak Transaksi Belanja</span>
    </a>
</li>
{{-- <li>
    <a class="menu-toggle">
        <i class="material-icons">archive</i>
        <span>Laporan</span>
    </a>
    <ul class="ml-menu">
        <router-link tag="li" to="/laporan-transaksi">
            <a>
                <i class="material-icons prefix">reorder</i>
                <span>Riwayat Transaksi Belanja</span>
            </a>
        </router-link>
        <router-link tag="li" to="/laporan-tagihanbank">
            <a>
                <i class="material-icons">payment</i>
                <span>Tagihan Bank</span>
            </a>
        </router-link>
    </ul>
</li> --}}