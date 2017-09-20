
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
    color: '#F44336',
    failedColor: '#FFEB3B',
    thickness: '70px'
})

const routes = [    
    {
        path: '/',
        component: require('./components/bank/dashboard.vue'),
    },
    {
        path: '/profil',
        component: require('./components/profil.vue'),
    },
    
    // adminBank
    {
        path: '/my',
        component: require('./components/bank/profilbank/index.vue'),
    },
    {
        path: '/master-kode',
        component: require('./components/bank/master-kodetransaksi/index.vue'),
    },
    {
        path: '/master-nasabah',
        component: require('./components/bank/master-nasabah/index.vue'),
    },
    {
        path: '/master-nasabah/:id',
        name: 'master-nasabah-show',
        component: require('./components/bank/master-nasabah/show.vue'),
    },
    {
        path: '/transaksi-setoran',
        component: require('./components/bank/transaksi-setoran/index.vue'),
    },
    {
        path: '/transaksi-penarikan',
        component: require('./components/bank/transaksi-penarikan/index.vue'),
    },
    // {
    //     path: '/laporan-aruskas',
    //     component: require('./components/bank/laporan-aruskas/index.vue'),
    // },
    {
        path: '/laporan-tagihankoperasi',
        component: require('./components/bank/laporan-tagihankoperasi/index.vue'),
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
}).$mount('#app-bank')