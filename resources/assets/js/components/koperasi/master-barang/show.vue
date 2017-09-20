<template id="index">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12">
                <!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-red">
                        <li><a><i class="material-icons">home</i> Navigasi Utama</a></li>
                        <li><a><i class="material-icons">archive</i> Master</a></li>
                        <router-link tag="li" to="/master-barang">
                            <a><i class="material-icons">work</i> Barang</a>
                        </router-link>
                        <li class="active"> {{ good.name }}</li>
                    </ol>
                </div>
                <!-- Cek jika good tidak ada -->
                <div v-if="!good.id">
                    <div class="card">
                        <div class="header">
                            <h2>Master Barang</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-xs-12">
                                    Maaf, data tidak ditemukan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Cek jika good ada -->
                <div v-else>
                    <!-- Foto good -->
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                        <a class="thumbnail card">
                            <img :src="good.picture" alt="Good" class="img-responsive" width="150px">
                        </a>
                    </div>
                    <!-- Data umum -->
                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>{{ good.name }}</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <dl class="dl-horizontal dl-small m-b-0">
                                            <dt>Pemilik</dt>
                                            <dd>{{ good.koperasi.name }}</dd>
                                            <dt>Kategori</dt>
                                            <dd>{{ good.category.name }}</dd>
                                            <dt>Harga</dt>
                                            <dd>{{ rupiah(good.price) }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <dl class="dl-horizontal dl-small m-b-0">
                                            <dt>Prioritas</dt>
                                            <dd>{{ good.priority == 'high' ? 'Tinggi' : 'Standar' }}</dd>
                                            <dt>Status</dt>
                                            <dd>{{ good.active == true ? 'Aktif' : 'Tidak aktif' }}</dd>
                                            <dt>Bergabung Sejak</dt>
                                            <dd>{{ momentDate(good.created_at) }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab -->
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#good_tab" data-toggle="tab">
                                            <i class="material-icons">work</i> INFORMASI BARANG
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#stock_tab" data-toggle="tab">
                                            <i class="material-icons">list</i> RIWAYAT STOK
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Personal tab -->
                                    <div role="tabpanel" class="tab-pane fade in active" id="good_tab">
                                        <form class="form-horizontal" @submit.prevent="updateGood">
                                            <fieldset id="goodForm" disabled>
                                                <!-- id -->
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="id">ID</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="id" name="id" class="form-control" :value="good.id" readonly>
                                                            </div>
                                                            <label id="id-error" class="error" for="id">{{ error(errors.id) }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- name -->
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="name">Nama Barang</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="name" name="name" class="form-control" v-model="good.name">
                                                            </div>
                                                            <label id="name-error" class="error" for="name">{{ error(errors.name) }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- category -->
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="category">Kategori Barang</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <select class="form-control show-tick" v-model="good.category_id" id="category_id">
                                                                <option disabled value="null">-- Pilih salah satu --</option>
                                                                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                                            </select>
                                                            <label id="category_id-error" class="error" for="category_id">{{ error(errors.category_id) }}</label>
                                                            <label class="error" v-if="arrayLength(categories) == 0">Maaf, kategori barang tidak ditemukan. Silahkan hubungi admin untuk informasi lebih lanjut.</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- description -->
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="description">Deskripsi</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea id="description" class="form-control no-resize" rows="4" v-model="good.description"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- priority -->
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="priority">Prioritas</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <input type="radio" id="high" value="high" class="with-gap radio-col-blue" v-model="good.priority" />
                                                            <label for="high">Tinggi</label>
                                                            <input type="radio" id="standard" value="standard" class="with-gap radio-col-grey" v-model="good.priority" />
                                                            <label for="standard">Biasa</label>
                                                        </div>
                                                        <label id="priority-error" class="error" for="priority">{{ error(errors.priority) }}</label>
                                                    </div>
                                                </div>
                                                <!-- price -->
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="price">Harga</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp</span>
                                                            <div class="form-line">
                                                                <input type="number" min="0" id="price" class="form-control" v-model="good.price">
                                                            </div>
                                                            <label id="price-error" class="error" for="price">{{ error(errors.price) }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- active -->
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="active">Aktif</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <input type="radio" id="true" value="1" class="with-gap radio-col-green" v-model="good.active" />
                                                            <label for="true">Ya</label>
                                                            <input type="radio" id="false" value="0" class="with-gap radio-col-orange" v-model="good.active" />
                                                            <label for="false">Tidak</label>
                                                        </div>
                                                        <label id="active-error" class="error" for="active">{{ error(errors.active) }}</label>
                                                    </div>
                                                </div>
                                                <!-- picture -->
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="picture">Ubah Gambar</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <input type="file" id="picture" class="form-control" @change="onFileChange">
                                                            <label id="picture-error" class="error" for="picture">{{ error(errors.picture) }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- created_at -->
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="created_at">Ditambahkan Pada</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="datetime" id="created_at" name="created_at" class="form-control" :value="momentDate2(good.created_at)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- updated_at -->
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label for="updated_at">Terakhir Diubah</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="datetime" id="updated_at" name="updated_at" class="form-control" :value="momentDate2(good.updated_at)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="row clearfix">
                                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" v-if="goodEditButton">
                                                    <button type="button" class="btn btn-danger m-t-15 waves-effect" @click="showGoodEdit(false)">BATAL</button>
                                                    <button type="submit" class="btn btn-success m-t-15 waves-effect">SIMPAN</button>
                                                </div>
                                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" v-else>
                                                    <button type="button" class="btn btn-primary m-t-15 waves-effect" @click="showGoodEdit(true)">EDIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Stock tab -->
                                    <div role="tabpanel" class="tab-pane fade" id="stock_tab">
                                        <div class="body table-responsive">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <!-- Tabel data -->
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th width="5%" class="text-center">No.</th>
                                                                <th>ID Stok</th>
                                                                <th>Jumlah</th>
                                                                <th>Ditambahkan pada</th>
                                                                <th>Ditambahkan oleh</th>
                                                                <th>Keterangan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(stock, index) in good.stocks">
                                                                <td class="text-center">{{ index+1 }}</td>
                                                                <td>{{ stock.id }}</td>
                                                                <td>{{ stock.value }}</td>
                                                                <td>{{ momentDate2(stock.created_at) }}</td>
                                                                <td>{{ stock.user.name }}</td>
                                                                <td v-html="labelType(stock.value)"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
import accounting from 'accounting'

export default {
    data () {
        return {
            api: {
                show: 'api/koperasi/barang/',
                categories: 'api/koperasi/kategori/get'
            },
            good: {
                name: null
            },
            categories: null,
            response: null,
            errors: [],
            goodEditButton: false,
        }
    },

    mounted () {
        this.getGood(this.api.show)
        this.getCategories(this.api.categories)
    },

    methods : {
        getGood(url) {
            this.$Progress.start()
            axios.get(url+this.$route.params.id)
            .then(response => {
                this.good = response.data
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },

        getCategories(url) {
            this.$Progress.start()
            axios.get(url)
            .then(response => {
                this.categories = response.data
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },

        updateGood() {
            this.$Progress.start()
            axios.put(this.api.show+this.good.id, this.good)
            .then(response => {
                if(response.data.success == true) {
                    this.response = response.data
                    this.$Progress.finish()
                    this.notify()
                    this.showGoodEdit(false)
                    this.getGood(this.api.show)
                }
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
                this.errors = errors.response.data
                this.response = response.data
            })
        },

        showGoodEdit(value) {
            this.goodEditButton = value
            if (value == true) {                
                $("#goodForm").removeAttr('disabled')
            } else if (value == false) {
                this.getGood(this.api.show)
                this.reset()
                $("#goodForm").attr('disabled', 'true')
            }
        },

        error(field) {
            return _.head(field)
        },

        reset() {
            $('#picture').val('')
            this.errors                  = []
            this.response                = null
        },

        momentDate(value) {
            return (value == null) 
            ? '' 
            : moment(value).locale('id').format('LL')
        },

        momentDate2(value) {
            return (value == null) 
            ? '' 
            : moment(value).locale('id').format('Do MMMM YYYY, HH:mm:ss')
        },

        labelType(value) {
            return value >= 0
                    ? '<span class="label bg-lime">Menambah</span>'
                    : '<span class="label bg-brown">Mengurangi</span>'
        },

        labelPriority(value) {
            return value == 'High'
                    ? '<span class="label label-primary">Tinggi</span>'
                    : '<span class="label label-default">Standar</span>'
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
        },

        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },

        createImage(file) {
            let reader = new FileReader();
            reader.onload = (e) => {
                this.good.picture = e.target.result;
            };
            reader.readAsDataURL(file);
        },
    }
}
</script>