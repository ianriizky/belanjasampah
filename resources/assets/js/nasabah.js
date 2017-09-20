
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
    color: '#4CAF50',
    failedColor: '#FFEB3B',
    thickness: '70px'
})

const routes = [    
    {
        path: '/',
        component: require('./components/nasabah/dashboard.vue'),
    },
    {
        path: '/profil',
        component: require('./components/profil.vue'),
    },

    // nasabah    
    {
        path: '/riwayat',
        component: require('./components/nasabah/riwayattransaksi/index.vue'),
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
}).$mount('#app-nasabah')