<template>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12">
                <!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-indigo">
                        <li><a><i class="material-icons">home</i> Navigasi Utama</a></li>
                        <li><a><i class="material-icons">archive</i> Master</a></li>
                        <li class="active"><i class="material-icons">assignment</i> Peran</li>
                    </ol>
                </div>
                <!-- Konten utama -->
                <div class="card">
                    <!-- Header -->
                    <div class="header">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- Judul konten -->
                                <h2>
                                    Master Peran
                                </h2>
                            </div>
                        </div>
                    </div>
                    <!-- Body -->
                    <div class="body table-responsive" v-if="rows">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- Tabel data -->
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">No.</th>
                                            <th width="5%">Opsi</th>
                                            <th>Nama Peran</th>
                                            <th>Tampilan</th>
                                            <th>Keterangan</th>
                                            <th>Ditambahkan Pada</th>
                                            <th>Diubah Pada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in rows">
                                            <td class="text-center">{{ index+1 }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary waves-effect" @click="edit(row.id)" title="Edit">
                                                    <i class="material-icons">mode_edit</i>
                                                </button>
                                            </td>
                                            <td>{{ row.name }}</td>
                                            <td>{{ row.display_name }}</td>
                                            <td>{{ row.description }}</td>
                                            <td>{{ momentDate(row.created_at) }}</td>
                                            <td>{{ momentDate(row.updated_at) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                        <h4 class="modal-title">Edit Peran</h4>
                    </div>
                    <form class="form-horizontal add" @submit.prevent="update">
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
                            <!-- name -->
                            <div class="row clearfix">
                                <div class="col-xs-4 form-control-label">
                                    <label for="name">Nama Peran</label>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="name" id="name" class="form-control" v-model="state.name" disabled>
                                        </div>
                                        <label id="name-error" class="error" for="name">{{ error(errors.name) }}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- display_name -->
                            <div class="row clearfix">
                                <div class="col-xs-4 form-control-label">
                                    <label for="display_name">Tampilan</label>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="display_name" id="display_name" class="form-control" v-model="state.display_name">
                                        </div>
                                        <label id="display_name-error" class="error" for="display_name">{{ error(errors.display_name) }}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- description -->
                            <div class="row clearfix">
                                <div class="col-xs-4 form-control-label">
                                    <label for="description">Keterangan</label>
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
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success waves-effect"><b>Simpan</b></button>
                            <button type="button" class="btn btn-link waves-effect" @click="hideModal">Batal</button>
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
                index: 'api/sistem/peran'
            },
            rows: null,
            response: null,
            modalTitle: null,
            errors: [],
            state: {
                id: null,
                name: null,
                display_name: null,
                description: null
            }
        }
    },
    
    mounted () {
        this.getData(this.api.index)
    },

    methods: {
        getData(url) {
            this.$Progress.start()
            axios.get(url)
            .then(response => {
                this.rows = response.data
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
                this.state.name         = response.data.name
                this.state.display_name = response.data.display_name
                this.state.description  = response.data.description
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },

        edit(id) {
            this.showDetail(id)
            $('#modal').modal('show')
        },

        update() {
            this.$Progress.start()
            axios.put(this.api.index+'/'+this.state.id, this.state)
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
            this.state.name         = null
            this.state.display_name = null
            this.state.description  = null
            this.errors             = []
            this.response           = null
        },

        momentDate(value) {
            return (value == null) 
            ? '' 
            : moment(value).locale('id').format('Do MMMM YYYY, HH:mm:ss')
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