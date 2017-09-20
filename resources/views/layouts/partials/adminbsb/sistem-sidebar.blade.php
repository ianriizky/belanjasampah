<li class="header">NAVIGASI UTAMA</li>
<li>
    <a class="menu-toggle">
        <i class="material-icons">archive</i>
        <span>Master</span>
    </a>
    <ul class="ml-menu">
        <router-link tag="li" to="/master-peran">
            <a>
                <i class="material-icons">assignment</i>
                <span>Peran</span>
            </a>
        </router-link>
        <router-link tag="li" to="/master-kategori">
            <a>
                <i class="material-icons">shopping_cart</i>
                <span>Kategori Barang</span>
            </a>
        </router-link>
        <router-link tag="li" to="/master-kode">
            <a>
                <i class="material-icons">account_balance_wallet</i>
                <span>Kode Transaksi</span>
            </a>
        </router-link>
    </ul>
</li>
<li>
    <a class="menu-toggle">
        <i class="material-icons">assignment_turned_in</i>
        <span>Kelola</span>
    </a>
    <ul class="ml-menu">
        <router-link tag="li" to="/kelola-koperasi">
            <a>
                <i class="material-icons">store</i>
                <span>Koperasi Serba Usaha</span>
            </a>
        </router-link>
        <router-link tag="li" to="/kelola-bank">
            <a>
                <i class="material-icons">account_balance</i>
                <span>Bank Sampah</span>
            </a>
        </router-link>
    </ul>
</li>
<router-link tag="li" to="/user">
    <a>
        <i class="material-icons">supervisor_account</i>
        <span>Daftar User</span>
    </a>
</router-link>