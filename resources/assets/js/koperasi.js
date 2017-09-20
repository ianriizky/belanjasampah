
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: '#3F51B5',
    failedColor: '#FFEB3B',
    thickness: '70px'
})

const routes = [    
    {
        path: '/',
        component: require('./components/koperasi/dashboard.vue'),
    },
    {
        path: '/profil',
        component: require('./components/profil.vue'),
    },    

    // adminKoperasi
    {
        path: '/my',
        component: require('./components/koperasi/profilkoperasi/index.vue'),
    },
    {
        path: '/master-kategori',
        component: require('./components/koperasi/master-kategoribarang/index.vue'),
    },
    {
        path: '/master-barang',
        component: require('./components/koperasi/master-barang/index.vue'),
    },
    {
        path: '/master-barang/:id',
        name: 'master-barang-show',
        component: require('./components/koperasi/master-barang/show.vue'),
    },
    {
        path: '/stok',
        component: require('./components/koperasi/manajemenstok/index.vue'),
    },
    {
        path: '/transaksi',
        component: require('./components/koperasi/transaksibelanja/index.vue'),
    },
    {
        path: '/laporan-transaksi',
        component: require('./components/koperasi/laporan-transaksibelanja/index.vue'),
    },
    {
        path: '/laporan-tagihanbank',
        component: require('./components/koperasi/laporan-tagihanbank/index.vue'),
    },
]

const router = new VueRouter({ 
    routes,
    linkActiveClass: 'active'
})

Object.defineProperty(Vue.prototype, '$bus', {
    get() {
        return this.$root.bus;
    }
})

window.bus = new Vue({})

const app = new Vue({
    router,
    data: {
        bus: bus
    }
}).$mount('#app-koperasi')