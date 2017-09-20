<template id="index">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12">
                <!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-indigo">
                        <li><a><i class="material-icons">home</i> Navigasi Utama</a></li>
                        <li><a><i class="material-icons">assignment_turned_in</i> Kelola</a></li>
                        <li class="active"><i class="material-icons">account_balance</i> Bank Sampah</li>
                    </ol>
                </div>
                <!-- Konten utama -->
                <div class="card">
                    <!-- Header -->
                    <div class="header">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
                                <!-- Judul konten -->
                                <h2>
                                    Kelola Bank Sampah
                                </h2>
                            </div>
                            <!-- Tombol tambah -->
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                                <button type="button" class="btn btn-block btn-success waves-effect" @click="create">TAMBAH</button>
                            </div>
                        </div>
                    </div>
                    <!-- Body -->
                    <div class="body table-responsive">
                        <p v-if="rows.total < 0">Tunggu sebentar.</p>
                        <div class="row" v-else>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <!-- showdata -->
                                <div v-if="rows.total > 5">
                                    <div class="col-lg-5 col-md-5 col-sm-4 col-xs-4 form-control-label">
                                        <label for="limit">Tampilkan jumlah data :</label>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-7 col-xs-7">
                                        <select class="form-control" id="limit" v-model="params.limit" @change.prevent="getData(api.index)">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <!-- search -->
                                <form @submit.prevent="getData(api.index)" method="GET">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="search">Cari :</label>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input v-model="params.keyword" type="text" class="form-control" placeholder="Masukkan kata kunci">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <button type="submit" class="btn waves-effect" :class="color">
                                            <i class="material-icons" v-if="rows.total > 0">search</i>
                                            <i class="material-icons" v-else>refresh</i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xs-12">
                                <!-- Tabel data -->
                                <p v-if="rows.total == 0">Maaf, data kosong.</p> <!-- cek jika data tidak ada -->
                                <table class="table table-striped table-bordered table-hover" v-else>
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">No.</th>
                                            <th width="18%">Opsi</th>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Bergabung Sejak</th>
                                            <th width="10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in rows.data">
                                            <td class="text-center">{{ rows.from+index }}</td>
                                            <td>
                                                <router-link :to="{ name: 'kelola-bank-show', params: { id: row.id }}" tag="button" class="btn btn-info waves-effect" title="Lihat">
                                                    <i class="material-icons">description</i>
                                                </router-link>
                                                <button type="button" class="btn btn-success waves-effect" @click="activateConfirmation(row.id)" title="Aktifkan" v-if="row.active == false">
                                                    <i class="material-icons">thumb_up</i>
                                                </button>
                                                <button type="button" class="btn btn-warning waves-effect" @click="deactivateConfirmation(row.id)" title="Non-aktifkan" v-if="row.active == true">
                                                    <i class="material-icons">thumb_down</i>
                                                </button>
                                                <button type="button" class="btn btn-danger waves-effect" @click="destroyConfirmation(row.id)" title="Hapus">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </td>
                                            <td>{{ row.id }}</td>
                                            <td>{{ row.name }}</td>
                                            <td>{{ row.address }}</td>
                                            <td>{{ momentDate(row.created_at) }}</td>
                                            <td v-html="labelActive(row.active)"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-xs-6">
                                <!-- paginationbutton -->
                                <div class="pagination-button" v-if="rows.prev_page_url || rows.next_page_url">
                                    <button type="button" class="btn waves-effect" :class="color" @click.prevent="getData(rows.prev_page_url)" :disabled="!rows.prev_page_url">
                                        <i class="material-icons">fast_rewind</i>
                                    </button>
                                    <!-- <div class="btn-group" role="group" v-for="n in rows.last_page">
                                        <button type="button" class="btn waves-effect" :class="color" @click.prevent="getData(api.index, n)" :disabled="n == rows.current_page">{{ n }}</button>
                                    </div> -->
                                    <button type="button" class="btn waves-effect" :class="color" @click.prevent="getData(rows.next_page_url)" :disabled="!rows.next_page_url">
                                        <i class="material-icons">fast_forward</i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <!-- pagination-info -->
                                <p class="text-right" v-if="rows.total > 0">Menampilkan data <b>{{ rows.from }} - {{ rows.to }}</b> dari <b>{{ rows.total }} data</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal untuk tambah, edit, dan hapus -->
        <div id="modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ modalTitle }} Bank Sampah</h4>
                    </div>
                    <form class="form-horizontal add" @submit.prevent="formAction(state.id)">
                        <div v-if="modalTitle == 'Tambah'">
                            <div class="modal-body">
                                <p>(*) harus diisi</p>
                                <!-- id -->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="id">ID *</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="id" class="form-control" v-model="state.id" readonly>
                                            </div>
                                            <label id="id-error" class="error" for="id">{{ error(errors.id) }}</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- user_id -->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="user_id">Pemilik *</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <select class="form-control show-tick" v-model="state.user_id">
                                                <option disabled value="null">-- Pilih salah satu --</option>
                                                <option v-for="user in users" :value="user.id">{{ user.id }} ({{ user.name }})</option>
                                            </select>
                                            <label id="user_id-error" class="error" for="user_id">{{ error(errors.user_id) }}</label>
                                            <label class="error" v-if="arrayLength(users) == 0">Maaf, daftar pemilik kosong. Silahkan tambah pemilik di menu Daftar User.</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- name -->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="name">Nama Bank Sampah *</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="name" class="form-control" v-model="state.name">
                                            </div>
                                            <label id="name-error" class="error" for="name">{{ error(errors.name) }}</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- address -->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="description">Alamat</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea id="address" rows="4" class="form-control no-resize" v-model="state.address"></textarea>
                                            </div>
                                            <label id="address-error" class="error" for="address">{{ error(errors.address) }}</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- description -->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="description">Profil Bank</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea id="description" rows="4" class="form-control no-resize" v-model="state.description"></textarea>
                                            </div>
                                            <label id="description-error" class="error" for="description">{{ error(errors.description) }}</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- active -->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="active">Aktif</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <input type="radio" id="true" value="1" class="with-gap radio-col-green" v-model="state.active" />
                                            <label for="true">Ya</label>
                                            <input type="radio" id="false" value="0" class="with-gap radio-col-orange" v-model="state.active" />
                                            <label for="false">Tidak</label>
                                        </div>
                                        <label id="active-error" class="error" for="active">{{ error(errors.active) }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success waves-effect"><b>Simpan</b></button>
                                <button type="button" class="btn btn-link waves-effect" @click="hideModal">Batal</button>
                            </div>
                        </div>
                        <div v-if="modalTitle == 'Hapus' | modalTitle == 'Aktivasi' | modalTitle == 'Deaktivasi'">
                            <div class="modal-body" v-if="modalTitle == 'Hapus'">
                                Apakah anda yakin ingin menghapus <b>{{ state.name }}</b>?
                            </div>
                            <div class="modal-body" v-if="modalTitle == 'Aktivasi'">
                                Apakah anda yakin ingin mengaktifkan <b>{{ state.name }}</b>?
                            </div>
                            <div class="modal-body" v-if="modalTitle == 'Deaktivasi'">
                                Apakah anda yakin ingin menonaktifkan <b>{{ state.name }}</b>?
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success waves-effect"><b>Ya</b></button>
                                <button type="button" class="btn btn-link waves-effect" @click="hideModal">Tidak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'

export default {
    data () {
        return {
            api: {
                index: 'api/sistem/bank',
                lastid: 'api/sistem/bank/getLastID',
                users: 'api/sistem/user/getIDForBank'
            },
            color: 'bg-indigo',
            rows: {
                total: -1
            },
            users: null,
            response: null,
            modalTitle: null,
            errors: [],
            state: {
                id: null,
                user_id: null,
                name: null,
                address: null,
                description: null,
                order_number: null,
                active: null
            },
            params: {
                limit: '5',
                keyword: null
            },
        }
    },
    
    mounted () {
        this.getData(this.api.index)
        // $('#select2my').select2()
    },

    methods: {
        getData(url, page = null) {
            this.$Progress.start()
            axios.get(url, {
                params: {
                    limit: this.params.limit,
                    keyword: this.params.keyword,
                    page: page
                }
            }).then(response => {
                this.rows = response.data
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },

        getLastID(url) {
            this.$Progress.start()
            axios.get(url)
            .then(response => {
                this.state.id           = response.data.id
                this.state.order_number = response.data.order_number
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },

        getUsers(url) {
            this.$Progress.start()
            axios.get(url)
            .then(response => {
                this.users = response.data
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },

        showDetail(id) {
            this.$Progress.start()
            axios.get(this.api.index+'/'+id)
            .then(response => {
                this.state.id           = response.data.id
                this.state.user_id      = response.data.user_id
                this.state.name         = response.data.name
                this.state.address      = response.data.address
                this.state.description  = response.data.description
                this.state.order_number = response.data.order_number
                this.state.active       = response.data.active
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },

        formAction(id = null) {
            if (this.modalTitle == 'Tambah') {
                this.send()
            } else if (this.modalTitle == 'Hapus') {
                this.delete()
            } else if (this.modalTitle == 'Aktivasi') {
                this.activate()
            } else if (this.modalTitle == 'Deaktivasi') {
                this.deactivate()
            }
        },

        create() {
            this.getLastID(this.api.lastid)
            this.getUsers(this.api.users)
            this.state.active = 1
            this.modalTitle = 'Tambah'
            $('#modal').modal('show')
        },

        send() {
            this.$Progress.start()
            axios.post(this.api.index, this.state)
            .then(response => {
                if(response.data.success == true) {
                    $('#modal').modal('hide')
                    this.response = response.data
                    this.$Progress.finish()
                    this.notify()
                    this.getData(this.api.index)
                    this.reset()
                }
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
                this.errors = errors.response.data
                this.response = response.data
            })
        },

        destroyConfirmation(id) {
            this.modalTitle = 'Hapus'
            this.showDetail(id)
            $('#modal').modal('show')
        },

        delete() {
            this.$Progress.start()
            axios.delete(this.api.index+'/'+this.state.id, {
                params: {
                    id: this.state.id,
                    name: this.state.name
                }
            }).then(response => {
                if(response.data.success == true) {
                    $('#modal').modal('hide')
                    this.response = response.data
                    this.$Progress.finish()
                    this.notify()
                    this.getData(this.api.index)
                    this.reset()
                }
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
                this.errors = errors.response.data
                $('#modal').modal('hide')
                this.response = response.data
            })
        },

        activateConfirmation(id) {
            this.modalTitle = 'Aktivasi'
            this.showDetail(id)
            $('#modal').modal('show')
        },

        activate() {
            axios.post(this.api.index+'/'+this.state.id+'/activate')
            .then(response => {
                if(response.data.success == true) {
                    $('#modal').modal('hide')
                    this.response = response.data
                    this.$Progress.finish()
                    this.notify()
                    this.getData(this.api.index)
                    this.reset()
                }
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
                this.errors = errors.response.data
                this.response = response.data
            })
        },

        deactivateConfirmation(id) {
            this.modalTitle = 'Deaktivasi'
            this.showDetail(id)
            $('#modal').modal('show')
        },

        deactivate() {
            axios.post(this.api.index+'/'+this.state.id+'/deactivate')
            .then(response => {
                if(response.data.success == true) {
                    $('#modal').modal('hide')
                    this.response = response.data
                    this.$Progress.finish()
                    this.notify()
                    this.getData(this.api.index)
                    this.reset()
                }
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
                this.errors = errors.response.data
                this.response = response.data
            })
        },

        hideModal() {
            $('#modal').modal('hide')
            this.reset()
        },

        error(field) {
            return _.head(field)
        },

        reset() {
            this.state.id           = null
            this.state.user_id      = null
            this.state.name         = null
            this.state.address      = null
            this.state.description  = null
            this.state.order_number = null
            this.state.active       = null
            this.users              = null
            this.errors             = []
            this.response           = null
        },

        labelActive(value) {
            return value == true
                    ? '<span class="label label-success">Aktif</span>'
                    : '<span class="label label-warning">Tidak aktif</span>'
        },

        momentDate(value) {
            return (value == null) 
            ? '' 
            : moment(value).locale('id').fromNow()
        },

        arrayLength(value) {
            return _.size(value)
        },

        notify() {
            var allowDismiss = true
            $.notify({
                message: this.response.message
            },
            {
                type: this.response.alert,
                allow_dismiss: true,
                newest_on_top: true,
                timer: 1000,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
            });
        }
    }
}
</script>