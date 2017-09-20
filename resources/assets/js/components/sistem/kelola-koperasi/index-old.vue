<template>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
                                <h2>
                                    Master Koperasi Serba Usaha
                                </h2>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                                <button type="button" class="btn btn-block btn-success waves-effect">TAMBAH</button>
                            </div>
                        </div>                                                   
                    </div>
                    <div class="body">
                        <div class="row" v-if="rows">
                            <form action="">
                                <div class="col-lg-7 col-md-7 col-sm-5 col-xs-5 form-control-label">
                                    <label for="search">Cari :</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="search" id="search" class="form-control" placeholder="Masukkan kata kunci">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                    <button type="submit" class="btn bg-indigo waves-effect">
                                        <i class="material-icons">search</i>
                                    </button>
                                </div>
                            </form>
                            <div class="col-xs-12">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Opsi</th>
                                            <th class="text-center">No.</th>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Pemilik</th>
                                            <th>Bergabung sejak</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in rows.data">
                                            <td>Opsi</td>
                                            <td class="text-center">{{ rows.from+index }}</td>
                                            <td>{{ row.id }}</td>
                                            <td>{{ row.name }}</td>
                                            <td>{{ row.address }}</td>
                                            <td>{{ row.user.name }}</td>
                                            <td>{{ row.created_at }}</td>
                                            <td>{{ row.active == 'y' ? 'Aktif' : 'Tidak aktif'  }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-xs-6">
                                <div class="pagination-button" v-if="rows.prev_page_url || rows.next_page_url">
                                    <button type="button" class="btn bg-indigo waves-effect" @click.prevent="getIndex(rows.prev_page_url)" :disabled="!rows.prev_page_url">
                                        <i class="material-icons">fast_rewind</i>
                                    </button>
                                    <div class="btn-group" role="group" v-for="n in rows.last_page">
                                        <button type="button" class="btn bg-indigo waves-effect" @click.prevent="getIndex(paginationPath(n))" :disabled="n==rows.current_page">{{ n }}</button>
                                    </div>
                                    <button type="button" class="btn bg-indigo waves-effect" @click.prevent="getIndex(rows.next_page_url)" :disabled="!rows.next_page_url">
                                        <i class="material-icons">fast_forward</i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <p class="text-right">Menampilkan data <b>{{ rows.from }} - {{ rows.to }}</b> dari <b>{{ rows.total }} data</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</template>

<script>
import moment from 'moment'
import VueEvents from 'vue-events'

Vue.use(VueEvents)

export default {
    components : {

    },

    data () {
        return {
            api: {
                index: 'sistem/api/koperasi'
            },
            rows: null,
        }
    },

    mounted() {
        this.getIndex(this.api.index)
    },

    methods: {
        getIndex(url) {
            this.$Progress.start()
            axios.get(url).then(response => {
                this.rows = response.data
                this.$Progress.finish()
            }).catch(errors => {
                console.error(errors)
                this.$Progress.fail()
            })
        },
        paginationPath(page) {
            return this.api.index + '?page=' + page
        }
    }
}
</script>