<template>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12">
                <!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-red">
                        <li><a><i class="material-icons">home</i> Navigasi Utama</a></li>
                        <li class="active"><i class="material-icons">receipt</i> Transaksi Belanja</li>
                    </ol>
                </div>
                <!-- Konten utama -->
                <div class="card">
                    <!-- Header -->
                    <div class="header">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-4 col-xs-12">
                                <!-- Judul konten -->
                                <h2>
                                    Transaksi Belanja
                                </h2>
                            </div>
                            <!-- Tombol tambah -->
                            <!-- <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                                <button type="button" class="btn btn-block btn-success waves-effect" @click="create">TAMBAH</button>
                            </div> -->
                            <!-- Tampilkan semua -->
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                                <button type="button" class="btn btn-block btn-info waves-effect" @click="getAllData(api.index)">TAMPILKAN SEMUA</button>
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
                            <!-- <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <form @submit.prevent="getData(api.index)" method="GET">
                                    <div class="col-xs-10">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input v-model="params.keyword" type="text" class="form-control" placeholder="Cari">
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
                            </div> -->
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <!-- date -->
                                <form @submit.prevent="getData(api.index)" method="GET">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="search">Tanggal :</label>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input v-model="params.date" type="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <button type="submit" class="btn waves-effect" :class="color">
                                            <i class="material-icons">autorenew</i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xs-12">
                                <!-- Tabel data -->
                                <p v-if="rows.total == 0 || rows.data[0].customer == null">Maaf, data kosong.</p> <!-- cek jika data tidak ada -->
                                <table class="table table-striped table-bordered table-hover" v-else>
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">No.</th>
                                            <th width="5%">Opsi</th>
                                            <th width="5%">ID</th>
                                            <th>Nama Nasabah</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total transaksi</th>
                                            <th>Ditambahkan pada</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in rows.data">
                                            <td class="text-center">{{ rows.from+index }}</td>
                                            <td>
                                                <button type="button" class="btn btn-success waves-effect" @click="activateConfirmation(row.id)" title="Verifikasi" v-if="row.status == 'processed'">
                                                    <i class="material-icons">thumb_up</i>
                                                </button>
                                                <button type="button" class="btn btn-warning waves-effect" @click="deactivateConfirmation(row.id)" title="Sedang diproses" v-if="row.status == 'verified'">
                                                    <i class="material-icons">thumb_down</i>
                                                </button>
                                            </td>
                                            <td>{{ row.id }}</td>
                                            <td>{{ row.customer.user.name }}</td>
                                            <td>{{ row.detailreceipts.good.name }}</td>
                                            <td>{{ row.detailreceipts.damount }}</td>
                                            <td>{{ row.detailreceipts.dprice }}</td>
                                            <td>{{ rupiah(row.total) }}</td>
                                            <td>{{ momentDate(row.created_at) }}</td>
                                            <td v-html="labelActive(row.status)"></td>
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
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ modalTitle }} Transaksi Bank Sampah</h4>
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
                                <!-- customer_id -->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="name">Nama Nasabah *</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <select class="form-control show-tick" v-model="state.customer_id" id="customer_id">
                                                <option disabled value="null">-- Pilih salah satu --</option>
                                                <option v-for="customer in customers" :value="customer.id">{{ customer.user.name }}</option>
                                            </select>
                                            <label id="customer_id-error" class="error" for="customer_id">{{ error(errors.customer_id) }}</label>
                                            <label class="error" v-if="arrayLength(customers) == 0">Maaf, nasabah tidak ditemukan. Silahkan tambah nasabah di menu Manajemen Nasabah.</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- code_id -->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="description">Kode Transaksi *</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <select class="form-control show-tick" v-model="state.code_id" id="code_id">
                                                <option disabled value="null">-- Pilih salah satu --</option>
                                                <option v-for="code in codes" :value="code.id">{{ code.name }}</option>
                                            </select>
                                            <label id="code_id-error" class="error" for="code_id">{{ error(errors.code_id) }}</label>
                                            <label class="error" v-if="arrayLength(codes) == 0">Maaf, kode transaksi tidak ditemukan. Silahkan hubungi admin untuk proses selanjutnya.</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- value -->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="value">Jumlah *</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            <div class="form-line">
                                                <input type="number" min="0" id="value" class="form-control" v-model="state.value">
                                            </div>
                                            <label id="value-error" class="error" for="value">{{ error(errors.value) }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success waves-effect"><b>Simpan</b></button>
                                <button type="button" class="btn btn-link waves-effect" @click="hideModal">Batal</button>
                            </div>
                        </div>
                        <div v-if="modalTitle == 'Aktivasi' || modalTitle == 'Deaktivasi' || modalTitle == 'Reset Password' || modalTitle == 'Hapus'">
                            <div class="modal-body" v-if="modalTitle == 'Aktivasi'">
                                <p>{{ errors }}</p>
                                Apakah anda yakin ingin memverifikasi <b>{{ state.id }}</b>?
                            </div>
                            <div class="modal-body" v-if="modalTitle == 'Deaktivasi'">
                                Apakah anda yakin ingin menonverifikasi <b>{{ state.id }}</b>?
                            </div>
                            <div class="modal-body" v-if="modalTitle == 'Reset Password'">
                                Apakah anda yakin ingin mereset password dari <b>{{ state.name }}</b> (password menjadi: <b>123456</b>)?
                            </div>
                            <div class="modal-body" v-if="modalTitle == 'Hapus'">
                                Apakah anda yakin ingin menghapus <b>{{ state.name }}</b>?
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
                index: 'api/koperasi/transaksi',
                lastid: 'api/koperasi/transaksi/getLastID'
            },
            color: 'bg-red',
            rows: {
                total: -1
            },
            customers: null,
            codes: null,
            // 
            response: null,
            modalTitle: null,
            errors: [],
            state: {
                // users
                id: null,
                code_id: null,
                customer_id: null,
                value: null,
            },
            params: {
                limit: '5',
                keyword: null,
                date: null
            },
        }
    },

    mounted () {
        this.params.date = this.momentToday('YYYY-MM-DD')
        this.getData(this.api.index)
    },

    methods: {
        getAllData(url) {
            this.params.keyword = null
            this.params.date = null
            this.getData(url)
        },

        getData(url) {
            this.$Progress.start()
            axios.get(url, {
                params: {
                    limit: this.params.limit,
                    keyword: this.params.keyword,
                    date: this.params.date
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
                this.state.id = response.data.id
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },

        getCustomers(url) {
            this.$Progress.start()
            axios.get(url)
            .then(response => {
                this.customers = response.data
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },

        getCodes(url) {
            this.$Progress.start()
            axios.get(url)
            .then(response => {
                this.codes = response.data
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
                this.state.id               = response.data.id
                this.state.code_id          = response.data.code_id
                this.state.customer_id      = response.data.customer_id
                this.state.value            = response.data.value
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
            }
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
            this.state.code_id      = null
            this.state.customer_id  = null
            this.state.value        = null
            this.errors             = []
            this.response           = null
        },

        labelActive(value) {
            return value == 'verified'
                    ? '<span class="label label-success">Terverifikasi</span>'
                    : '<span class="label label-warning">Sedang diproses</span>'
        },

        momentDate(value) {
            return (value == null) 
            ? '' 
            : moment(value).locale('id').calendar()
        },

        rupiah(value) {
            var options = {
                symbol : 'Rp',
                decimal : ',',
                thousand: '.',
                precision : 2,
                format: {
                    pos : "%s %v",
                    neg : "%s (%v)",
                    zero: "%s  -"
                }
            }
            return accounting.formatMoney(value, options)
        },

        momentToday(format) {
            return moment().format(format)
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