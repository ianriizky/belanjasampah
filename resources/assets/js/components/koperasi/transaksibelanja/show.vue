<template id="index">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12">
                <!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-green">
                        <li><a><i class="material-icons">home</i> Navigasi Utama</a></li>
                        <li><a><i class="material-icons">archive</i> Master</a></li>
                        <router-link tag="li" to="/master-nasabah">
                            <a><i class="material-icons">assignment_ind</i> Nasabah</a>
                        </router-link>
                        <li class="active"> {{ customer.user.name }}</li>
                    </ol>
                </div>
                <!-- Cek jika customer tidak ada -->
                <div v-if="!customer.id">
                    <div class="card">
                        <div class="header">
                            <h2>Manajemen Nasabah</h2>
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
                <!-- Cek jika customer ada -->
                <div v-else>
                    <!-- Foto customer (dari gravatar) -->
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                        <a class="thumbnail card">
                            <img :src="customer.user.picture" alt="User" class="img-responsive" width="150px">
                        </a>
                    </div>
                    <!-- Data umum -->
                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>{{ customer.user.name }}</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <dl class="dl-horizontal dl-small m-b-0">
                                            <dt>ID</dt>
                                            <dd>{{ customer.id }}</dd>
                                            <dt>E-mail</dt>
                                            <dd>{{ customer.user.email }}</dd>
                                            <dt>Alamat</dt>
                                            <dd>{{ customer.user.address }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <dl class="dl-horizontal dl-small m-b-0">
                                            <dt>Nomor Telepon</dt>
                                            <dd>{{ customer.user.phone_number }}</dd>
                                            <dt>Tanggal Lahir</dt>
                                            <dd>{{ momentDate(customer.user.birth_date) }}</dd>
                                            <dt>Bergabung Sejak</dt>
                                            <dd>{{ momentDate(customer.created_at) }}</dd>
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
                                        <a href="#personal_tab" data-toggle="tab">
                                            <i class="material-icons">face</i> PERSONAL
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#roles_tab" data-toggle="tab">
                                            <i class="material-icons">history</i> RIWAYAT TRANSAKSI
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Personal tab -->
                                    <div role="tabpanel" class="tab-pane fade in active" id="personal_tab">
                                        <fieldset id="customerForm" disabled>
                                            <!-- id -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="id">ID</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="id" name="id" class="form-control" v-model="customer.id">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- email -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="email">E-mail</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="email" id="email" name="email" class="form-control" v-model="customer.user.email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- name -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="name">Nama Lengkap</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="name" name="name" class="form-control" v-model="customer.user.name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- address -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="address">Alamat</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="address" name="address" class="form-control" v-model="customer.user.address">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- phone_number -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="phone_number">Nomor Telepon</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="phone_number" name="phone_number" class="form-control" v-model="customer.user.phone_number">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- gender -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="gender">Jenis Kelamin</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <input id="laki" name="gender" type="radio" value="male" class="with-gap radio-col-light-blue" v-model="customer.user.gender"/>
                                                        <label for="laki">Laki-laki</label>
                                                        <input id="perempuan" name="gender" type="radio" value="female" class="with-gap radio-col-pink" v-model="customer.user.gender"/>
                                                        <label for="perempuan">Perempuan</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- birth_date -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="birth_date">Tanggal Lahir</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="date" id="birth_date" name="birth_date" class="form-control" v-model="customer.user.birth_date">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- created_at -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="created_at">Bergabung sejak</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="datetime" id="created_at" name="created_at" class="form-control" :value="momentDate2(customer.created_at)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- updated_at -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="updated_at">Terakhir diubah</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="datetime" id="updated_at" name="updated_at" class="form-control" :value="momentDate2(customer.updated_at)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <!-- Roles tab -->
                                    <div role="tabpanel" class="tab-pane fade" id="roles_tab">
                                        <div class="body table-responsive">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <!-- Tabel data -->
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th width="5%" class="text-center">No.</th>
                                                                <th>ID Transaksi</th>
                                                                <th>Kode</th>
                                                                <th>Jumlah</th>
                                                                <th>Ditambahkan pada</th>
                                                                <th>Keterangan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(row, index) in customer.transactions">
                                                                <td class="text-center">{{ index+1 }}</td>
                                                                <td>{{ row.id }}</td>
                                                                <td>{{ row.code_id }}</td>
                                                                <td>{{ rupiah(row.value) }}</td>
                                                                <td>{{ momentDate2(row.created_at) }}</td>
                                                                <td>{{ row.code.name }}</td>
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
                show: 'api/bank/nasabah/',
            },
            customer: {
                user: {
                    name: null
                },
                transactions: null
            },
        }
    },

    mounted () {
        this.getCustomer(this.api.show)
    },

    methods : {
        getCustomer(url) {
            this.$Progress.start()
            axios.get(url+this.$route.params.id)
            .then(response => {
                this.customer = response.data
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
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
    }
}
</script>