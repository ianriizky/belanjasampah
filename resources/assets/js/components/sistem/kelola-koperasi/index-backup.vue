<template>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12">
                <!-- Notifikasi -->
                <div id="alert" class="alert alert-dismissible" :class="response.alert" role="alert" v-if="response.message">
                    <button type="button" class="close" aria-label="Close" @click="hideAlert"><span aria-hidden="true">&times;</span></button>
                    {{ response.message }}
                </div>
                <!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-indigo">
                        <li><a><i class="material-icons">assignment_turned_in</i> Aktivasi</a></li>
                        <li class="active"><i class="material-icons">store</i> Koperasi Serba Usaha</li>
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
                                    Aktivasi Koperasi Serba Usaha
                                </h2>
                            </div>
                            <!-- Tombol tambah -->
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                                <button type="button" class="btn btn-block btn-success waves-effect" @click="create">TAMBAH</button>
                            </div>
                        </div>
                    </div>
                    <!-- Body -->
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <showdata></showdata>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <search color="bg-indigo"></search>
                            </div>
                            <div class="col-xs-12">
                                <!-- Tabel data -->
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">No.</th>
                                            <th width="13%">Opsi</th>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Pemilik</th>
                                            <th>Bergabung sejak</th>
                                            <th width="13%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in rows.data">
                                            <td class="text-center">{{ rows.from+index }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary waves-effect" @click="edit(row.id)">
                                                    <i class="material-icons">mode_edit</i>
                                                </button>
                                                <button type="button" class="btn btn-danger waves-effect" @click="destroyConfirmation(row.id)">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </td>
                                            <td>{{ row.id }}</td>
                                            <td>{{ row.name }}</td>
                                            <td>{{ row.address }}</td>
                                            <td>{{ row.user.name }}</td>
                                            <td>{{ row.created_at }}</td>
                                            <td v-html="labelActive(row.active)"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-xs-6">
                                <paginationbutton color="bg-indigo"></paginationbutton>
                            </div>
                            <div class="col-xs-6">
                                <paginationinfo></paginationinfo>
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
                        <h4 class="modal-title">{{ modalTitle }} Koperasi Serba Usaha</h4>
                    </div>
                    <form class="form-horizontal add" @submit.prevent="formAction(state.id)">
                        <div v-if="modalTitle == 'Tambah' || modalTitle == 'Edit'">
                            <div class="modal-body">
                                <!-- id -->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="id">ID</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" v-model="state.id" readonly>
                                            </div>
                                            <label id="id-error" class="error" for="id">{{ error(errors.id) }}</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- user_id (undone)-->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="id">Pemilik</label>
                                    </div>
                                    <div class="col-xs-8">

                                    </div>
                                </div>
                                <!-- name -->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="name">Nama Koperasi Serba Usaha</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="name" id="name" class="form-control" v-model="state.name">
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
                                                <textarea name="address" id="address" rows="4" class="form-control no-resize" v-model="state.address"></textarea>
                                            </div>
                                            <label id="address-error" class="error" for="address">{{ error(errors.address) }}</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- description -->
                                <div class="row clearfix">
                                    <div class="col-xs-4 form-control-label">
                                        <label for="description">Profil Koperasi</label>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea name="description" id="description" rows="4" class="form-control no-resize" v-model="state.description"></textarea>
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
                                            <input name="active" type="radio" id="true" value="1" class="with-gap radio-col-green" v-model="state.active" />
                                            <label for="true">Ya</label>
                                            <input name="active" type="radio" id="false" value="0" class="with-gap radio-col-red" v-model="state.active" />
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
                        <div v-if="modalTitle == 'Hapus'">
                            <div class="modal-body">
                                Apakah anda yakin ingin menghapus <b>{{ state.name }}</b> ini?
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
import showdata from '../../.myvuetable/showdata'
import search from '../../.myvuetable/search'
import paginationbutton from '../../.myvuetable/pagination-button'
import paginationinfo from '../../.myvuetable/pagination-info'

export default {
    components : {
        showdata,
        search,
        paginationbutton,
        paginationinfo
    },

    data () {
        return {
            api: {
                index: 'api/sistem/koperasi',
                lastid: 'api/sistem/koperasi/getLastID'
            },
            rows: {},
            response: {},
            modalTitle: null,
            errors: [],
            state: {
                id: null,
                user_id: null,
                name: null,
                address: null,
                description: null,
                active: null,
                created_at: null,
                updated_at: null
            }
        }
    },

    mounted () {
        this.getData(this.api.index)

        // listen when search
        this.$bus.$on('search', (event) => {
            let params = {
                keyword: event.keyword,
                limit: event.limit
            }
            this.getData(this.api.index, params)
        })

        this.$bus.$on('getData', url => {
            this.getData(url)
        })
    },

    methods: {
        getData(url, params = null) {
            this.$Progress.start()
            axios.get(url, {
                params
            }).then(response => {
                this.rows = response.data
                this.$bus.$emit('pagination', this.rows)
                this.$Progress.finish()
            }).catch(errors => {
                console.error(errors)
                this.$Progress.fail()
            })
        },

        getLastID() {
            axios.get(this.api.lastid)
            .then(response => {
                this.state.id = response.data.id
            }).catch(errors => {
                console.error(errors)
            })
        },

        showDetail(id) {
            axios.get(this.api.index+'/'+id+'/edit')
            .then(response => {
                this.state.id           = response.data.id
                this.state.name         = response.data.name
                this.state.description  = response.data.description
                this.state.active       = response.data.active
            }).catch(errors => {
                console.error(errors)
            })
        },

        formAction(id = null) {
            if (this.modalTitle == 'Tambah') {
                this.send()
            } else if (this.modalTitle == 'Edit') {
                this.update()
            } else if (this.modalTitle == 'Hapus') {
                this.delete()
            }
        },

        create() {
            this.getLastID(this.api.lastid)
            this.state.active = 1
            this.modalTitle = 'Tambah'
            $('#modal').modal('show')
        },

        send() {
            axios.post(this.api.index, this.state)
            .then(response => {
                if(response.data.success == true) {
                    this.reset()
                    $('#modal').modal('hide')
                    this.response = response.data
                    this.getData(this.api.index)
                }
            }).catch(errors => {
                console.error(errors)
                this.errors = errors.response.data
                this.response = response.data
            })
        },

        edit(id) {
            this.modalTitle = 'Edit'
            this.showDetail(id)
            $('#modal').modal('show')
        },

        update() {
            axios.put(this.api.index+'/'+this.state.id, this.state)
            .then(response => {
                if(response.data.success == true) {
                    this.reset()
                    $('#modal').modal('hide')
                    this.response = response.data
                    this.getData(this.api.index)
                }
            }).catch(errors => {
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
            axios.delete(this.api.index+'/'+this.state.id, {
                params: {
                    id: this.state.id,
                    name: this.state.name
                }
            }).then(response => {
                if(response.data.success == true) {
                    this.reset()
                    $('#modal').modal('hide')
                    this.response = response.data
                    this.getData(this.api.index)
                }
            }).catch(errors => {
                console.error(errors)
                this.errors = errors.response.data
                $('#modal').modal('hide')
                this.response = response.data

            })
        },

        hideAlert() {
            $('#alert').hide()
            this.response = {}
            this.reset()
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
            this.state.active       = null
            this.state.created_at   = null
            this.state.updated_at   = null
            this.errors = []
        },

        labelActive(value) {
            return value == true
                    ? '<span class="label label-success">Aktif</span>'
                    : '<span class="label label-danger">Tidak aktif</span>'
        }
    }
}
</script>