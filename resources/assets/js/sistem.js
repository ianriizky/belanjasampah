
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
    color: '#607D8B',
    failedColor: '#FFEB3B',
    thickness: '70px'
})

const routes = [    
    {
        path: '/',
        component: require('./components/sistem/dashboard.vue'),
    },
    {
        path: '/profil',
        component: require('./components/profil.vue'),
    },

    // adminSistem
    {
        path: '/master-peran',
        component: require('./components/sistem/master-peran/index.vue'),
    },
    {
        path: '/master-kategori',
        component: require('./components/sistem/master-kategoribarang/index.vue'),
    },
    {
        path: '/master-kode',
        component: require('./components/sistem/master-kodetransaksi/index.vue'),
    },
    {
        path: '/kelola-koperasi',
        component: require('./components/sistem/kelola-koperasi/index.vue'),
    },
    {
        path: '/kelola-koperasi/:id',
        name: 'kelola-koperasi-show',
        component: require('./components/sistem/kelola-koperasi/show.vue'),
    },
    {
        path: '/kelola-bank',
        component: require('./components/sistem/kelola-bank/index.vue'),
    },
    {
        path: '/kelola-bank/:id',
        name: 'kelola-bank-show',
        component: require('./components/sistem/kelola-bank/show.vue'),
    },
    {
        path: '/user',
        component: require('./components/sistem/daftaruser/index.vue'),
    },
    {
        path: '/user/:id',
        name: 'daftaruser-show',
        component: require('./components/sistem/daftaruser/show.vue'),
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

window.app = new Vue({
    router,
    data: {
        bus: bus
    }
}).$mount('#app-sistem')