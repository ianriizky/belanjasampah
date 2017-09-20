<router-link tag="li" to="/my">
    <a>
        <i class="material-icons">account_balance</i>
        <span>Bank Sampah Saya</span>
    </a>
</router-link>
<li class="header">NAVIGASI UTAMA</li>
<li>
    <a class="menu-toggle">
        <i class="material-icons">archive</i>
        <span>Master</span>
    </a>
    <ul class="ml-menu">
        <router-link tag="li" to="/master-kode">
            <a>
                <i class="material-icons">account_balance_wallet</i>
                <span>Kode Transaksi</span>
            </a>
        </router-link>
        <router-link tag="li" to="/master-nasabah">
            <a>
                <i class="material-icons">assignment_ind</i>
                <span>Nasabah</span>
            </a>
        </router-link>
    </ul>
</li>
<li>
    <a class="menu-toggle">
        <i class="material-icons">swap_horiz</i>
        <span>Transaksi Bank Sampah</span>
    </a>
    <ul class="ml-menu">
        <router-link tag="li" to="/transaksi-setoran">
            <a>
                <i class="material-icons">trending_up</i>
                <span>Setoran Sampah</span>
            </a>
        </router-link>
        <router-link tag="li" to="/transaksi-penarikan">
            <a>
                <i class="material-icons">trending_down</i>
                <span>Penarikan Tunai</span>
            </a>
        </router-link>
    </ul>
</li>
{{-- <li>
    <a class="menu-toggle">
        <i class="material-icons">content_paste</i>
        <span>Laporan</span>
    </a>
    <ul class="ml-menu">
        <router-link tag="li" to="/laporan-aruskas">
            <a>
                <i class="material-icons prefix">highlight_off</i>
                <span>Arus Kas</span>
            </a>
        </router-link>
        <router-link tag="li" to="/laporan-tagihankoperasi">
            <a>
                <i class="material-icons">book</i>
                <span>Tagihan Koperasi</span>
            </a>
        </router-link>
    </ul>
</li> --}}