<template>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12">
                <!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-green">
                        <li><a><i class="material-icons">home</i> Navigasi Utama</a></li>
                        <li><a><i class="material-icons">archive</i> Master</a></li>
                        <li class="active"><i class="material-icons">assignment_ind</i> Nasabah</li>
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
                                    Manajemen Nasabah
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
                                            <th width="23%">Opsi</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Saldo</th>
                                            <th>Bergabung Sejak</th>
                                            <th width="10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in rows.data">
                                            <td class="text-center">{{ rows.from+index }}</td>
                                            <td>
                                                <router-link :to="{ name: 'master-nasabah-show', params: { id: row.id }}" tag="button" class="btn btn-info waves-effect" title="Lihat">
                                                    <i class="material-icons">description</i>
                                                </router-link>
                                                <button type="button" class="btn btn-danger waves-effect" @click="resetPasswordConfirmation(row.id)" title="Reset Password">
                                                    <i class="material-icons">autorenew</i>
                                                </button>
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
                                            <td>{{ row.user.name }}</td>
                                            <td>{{ row.user.address }}</td>
                                            <td>{{ rupiah(row.balance) }}</td>
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
        <!-- Modal untuk aktivasi, deaktivasi, dan reset password -->
        <div id="modal" class="modal fade" tabindex="-1" role="dialog">
            <div v-if="modalTitle == 'Tambah'">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ modalTitle }} User</h4>
                        </div>
                        <div class="modal-body">
                            <p>(*) harus diisi</p>
                            <form class="form-horizontal add" @submit.prevent="formAction(state.id)">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <h5 class="modal-title text-center">Informasi Pribadi</h5>
                                        <!-- user_id -->
                                        <div class="row clearfix">
                                            <div class="col-xs-4 form-control-label">
                                                <label for="user_id">Username (ID) *</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="user_id" class="form-control" v-model="state.user_id" required>
                                                    </div>
                                                    <label id="user_id-error" class="error" for="user_id">{{ error(errors.user_id) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- user_email -->
                                        <div class="row clearfix">
                                            <div class="col-xs-4 form-control-label">
                                                <label for="user_email">E-mail *</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="email" id="user_email" class="form-control" v-model="state.user_email" required>
                                                    </div>
                                                    <label id="user_email-error" class="error" for="user_email">{{ error(errors.user_email) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- user_name -->
                                        <div class="row clearfix">
                                            <div class="col-xs-4 form-control-label">
                                                <label for="user_name">Nama Lengkap *</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="user_name" class="form-control" v-model="state.user_name" required>
                                                    </div>
                                                    <label id="user_name-error" class="error" for="user_name">{{ error(errors.user_name) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- user_address -->
                                        <div class="row clearfix">
                                            <div class="col-xs-4 form-control-label">
                                                <label for="user_address">Alamat</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <textarea id="user_address" rows="4" class="form-control no-resize" v-model="state.user_address"></textarea>
                                                    </div>
                                                    <label id="user_address-error" class="error" for="user_address">{{ error(errors.user_address) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- user_phone_number -->
                                        <div class="row clearfix">
                                            <div class="col-xs-4 form-control-label">
                                                <label for="user_phone_number">Nomor Telepon</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="user_phone_number" class="form-control" v-model="state.user_phone_number">
                                                    </div>
                                                    <label id="user_phone_number-error" class="error" for="user_phone_number">{{ error(errors.user_phone_number) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- user_gender -->
                                        <div class="row clearfix">
                                            <div class="col-xs-4 form-control-label">
                                                <label for="user_gender">Jenis Kelamin</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input type="radio" name="user_gender" id="male" value="male" class="with-gap radio-col-blue" v-model="state.user_gender" />
                                                    <label for="male">Laki-laki</label>
                                                    <input type="radio" name="user_gender" id="female" value="female" class="with-gap radio-col-pink" v-model="state.user_gender" />
                                                    <label for="female">Perempuan</label>
                                                </div>
                                                <label id="user_gender-error" class="error" for="user_gender">{{ error(errors.user_gender) }}</label>
                                            </div>
                                        </div>
                                        <!-- user_birth_date -->
                                        <div class="row clearfix">
                                            <div class="col-xs-4 form-control-label">
                                                <label for="user_birth_date">Tanggal Lahir</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="date" id="user_birth_date" class="form-control" v-model="state.user_birth_date">
                                                    </div>
                                                    <label id="user_birth_date-error" class="error" for="user_birth_date">{{ error(errors.user_birth_date) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- user_active -->
                                        <div class="row clearfix">
                                            <div class="col-xs-4 form-control-label">
                                                <label for="user_active">Aktif</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input type="radio" id="user_true" value="1" class="with-gap radio-col-green" v-model="state.user_active" />
                                                    <label for="user_true">Ya</label>
                                                    <input type="radio" id="user_false" value="0" class="with-gap radio-col-orange" v-model="state.user_active" />
                                                    <label for="user_false">Tidak</label>
                                                </div>
                                                <label id="user_active-error" class="error" for="user_active">{{ error(errors.user_active) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <h5 class="modal-title text-center">Password</h5>
                                        <!-- user_password -->
                                        <div class="row clearfix">
                                            <div class="col-xs-4 form-control-label">
                                                <label for="user_password">Password *</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" id="user_password" class="form-control" v-model="state.user_password" required>
                                                    </div>
                                                    <label id="user_password-error" class="error" for="user_password">{{ error(errors.user_password) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- user_password_confirmation -->
                                        <div class="row clearfix">
                                            <div class="col-xs-4 form-control-label">
                                                <label for="user_password_confirmation">Ulangi Password *</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" id="user_password_confirmation" class="form-control" v-model="state.user_password_confirmation" required>
                                                    </div>
                                                    <label id="user_password_confirmation-error" class="error" for="user_password_confirmation">{{ error(errors.user_password_confirmation) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <br>
                                        <br>
                                        <br>
                                        <h5 class="modal-title text-center">Informasi Nasabah</h5>
                                        <!-- customer_family_member -->
                                        <div class="row clearfix">
                                            <div class="col-xs-4 form-control-label">
                                                <label for="customer_family_member">Jumlah Anggota Keluarga</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" id="customer_family_member" class="form-control" min="0" v-model="state.customer_family_member">
                                                    </div>
                                                    <label id="customer_family_member-error" class="error" for="customer_family_member">{{ error(errors.customer_family_member) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- customer_active -->
                                        <div class="row clearfix">
                                            <div class="col-xs-4 form-control-label">
                                                <label for="customer_active">Status Nasabah</label>
                                            </div>
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <input type="radio" id="customer_true" value="1" class="with-gap radio-col-green" v-model="state.customer_active" />
                                                    <label for="customer_true">Aktif</label>
                                                    <input type="radio" id="customer_false" value="0" class="with-gap radio-col-orange" v-model="state.customer_active" />
                                                    <label for="customer_false">Tidak Aktif</label>
                                                </div>
                                                <label id="customer_active-error" class="error" for="customer_active">{{ error(errors.customer_active) }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success waves-effect"><b>Simpan</b></button>
                                            <button type="button" class="btn btn-link waves-effect" @click="hideModal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="modalTitle == 'Aktivasi' || modalTitle == 'Deaktivasi' || modalTitle == 'Reset Password' || modalTitle == 'Hapus'"> <!-- v-if -->
                <div class="modal-dialog" role="document">
                    <form class="form-horizontal add" @submit.prevent="formAction(state.id)">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{ modalTitle }} User</h4>
                            </div>
                            <div class="modal-body" v-if="modalTitle == 'Aktivasi'">
                                Apakah anda yakin ingin mengaktifkan <b>{{ state.user_name }}</b>?
                            </div>
                            <div class="modal-body" v-if="modalTitle == 'Deaktivasi'">
                                Apakah anda yakin ingin menonaktifkan <b>{{ state.user_name }}</b>?
                            </div>
                            <div class="modal-body" v-if="modalTitle == 'Reset Password'">
                                Apakah anda yakin ingin mereset password dari <b>{{ state.user_name }}</b> (password menjadi: <b>123456</b>)?
                            </div>
                            <div class="modal-body" v-if="modalTitle == 'Hapus'">
                                Apakah anda yakin ingin menghapus <b>{{ state.user_name }}</b>?
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
import accounting from 'accounting'

export default {
    data () {
        return {
            api: {
                index: 'api/bank/nasabah',
                bankid: 'api/bank/getBankID',
                lastid: 'api/bank/nasabah/getLastID'
            },
            color: 'bg-green',
            rows: {
                total: -1
            },
            response: null,
            modalTitle: null,
            errors: [],
            state: {
                // users
                user_id: null,
                user_email: null,
                user_name: null,
                user_address: null,
                user_phone_number: null,
                user_gender: null,
                user_birth_date: null,
                user_password: null,
                user_password_confirmation: null,
                user_active: null,
                // customers
                customer_id: null,
                customer_bank_id: null,
                customer_family_member: null,
                customer_active: null,
            },
            params: {
                limit: '5',
                keyword: null
            },
        }
    },

    mounted () {
        this.getData(this.api.index)
        this.getBankID(this.api.bankid)
    },

    methods: {
        getData(url) {
            this.$Progress.start()
            axios.get(url, {
                params: {
                    limit: this.params.limit,
                    keyword: this.params.keyword
                }
            }).then(response => {
                this.rows = response.data
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },

        getBankID(url) {
            axios.get(url)
            .then(response => {
                this.state.customer_bank_id = response.data.bank_id
            }).catch(errors => {
                console.error(errors)
            })
        },

        getLastID(url) {
            this.$Progress.start()
            axios.get(url)
            .then(response => {
                this.state.customer_id = response.data.id
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
                this.state.user_id           = response.data.user.id
                this.state.user_name         = response.data.user.name
                this.state.customer_id       = response.data.id
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },

        formAction(id = null) {
            if (this.modalTitle == 'Tambah') {
                this.send()
            } else if (this.modalTitle == 'Aktivasi') {
                this.activate()
            } else if (this.modalTitle == 'Deaktivasi') {
                this.deactivate()
            } else if (this.modalTitle == 'Reset Password') {
                this.resetPassword()
            } else if (this.modalTitle == 'Hapus') {
                this.delete()
            }
        },

        create() {
            this.state.user_active = 1
            this.state.customer_family_member = 0
            this.state.customer_active = 1
            this.getLastID(this.api.lastid)
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

        activateConfirmation(id) {
            this.modalTitle = 'Aktivasi'
            this.showDetail(id)
            $('#modal').modal('show')
        },

        activate() {
            axios.post(this.api.index+'/'+this.state.user_id+'/activate')
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
            axios.post(this.api.index+'/'+this.state.user_id+'/deactivate')
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

        resetPasswordConfirmation(id) {
            this.modalTitle = 'Reset Password'
            this.showDetail(id)
            $('#modal').modal('show')
        },

        resetPassword() {
            axios.post(this.api.index+'/'+this.state.user_id+'/reset')
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
            axios.delete(this.api.index+'/'+this.state.user_id, {
                params: {
                    name: this.state.user_name
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

        hideModal() {
            $('#modal').modal('hide')
            this.reset()
        },

        error(field) {
            return _.head(field)
        },

        reset() {
            this.state.user_id                      = null
            this.state.user_email                   = null
            this.state.user_name                    = null
            this.state.user_address                 = null
            this.state.user_phone_number            = null
            this.state.user_gender                  = null
            this.state.user_birth_date              = null
            this.state.user_password                = null
            this.state.user_password_confirmation   = null
            this.state.user_active                  = null
            this.state.customer_family_member       = null
            this.state.customer_active              = null
            this.errors                             = []
            this.response                           = null
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

        rupiah(value) {
            var options = {
                symbol : 'Rp',
                decimal : ',',
                thousand: '.',
                precision : 2,
                format: "%s%v"
            }
            return accounting.formatMoney(value, options)
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