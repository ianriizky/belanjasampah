<template id="index">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12">
                <!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-indigo">
                        <li><a><i class="material-icons">home</i> Navigasi Utama</a></li>
                        <li><a><i class="material-icons">assignment_turned_in</i> Kelola</a></li>
                        <router-link tag="li" to="/kelola-bank">
                            <a><i class="material-icons">account_balance</i> Bank Sampah</a>
                        </router-link>
                        <li class="active"> {{ bank.id }}</li>
                    </ol>
                </div>
               <!-- Cek jika bank tidak ada -->
                <div v-if="!bank.id">
                    <div class="card">
                        <div class="header">
                            <h2>Bank Sampah</h2>
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
                <!-- Cek jika bank ada -->
                <div v-else>
                    <!-- Foto Profil (dari gravatar) -->
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                        <a class="thumbnail card">
                            <img :src="bank.picture" alt="User" class="img-responsive" width="150px">
                        </a>
                    </div>
                    <!-- Data umum -->
                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>{{ bank.name }}</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <dl class="dl-horizontal dl-small m-b-0">
                                            <dt>ID</dt>
                                            <dd>{{ bank.id }}</dd>
                                            <dt>Nama Bank</dt>
                                            <dd>{{ bank.name }}</dd>
                                            <dt>Pemilik</dt>
                                            <dd>{{ bank.user.name }}</dd>
                                        </dl>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <dl class="dl-horizontal dl-small m-b-0">
                                            <dt>Alamat</dt>
                                            <dd>{{ bank.address }}</dd>
                                            <dt>Bergabung Sejak</dt>
                                            <dd>{{ momentDate(bank.created_at) }}</dd>
                                            <dt>Status</dt>
                                            <dd>{{ bank.active == true ? 'Aktif' : 'Tidak aktif' }}</dd>
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
                                        <a href="#information_tab" data-toggle="tab">
                                            <i class="material-icons">account_balance</i> INFORMASI BANK
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#other_tab" data-toggle="tab">
                                            <i class="material-icons">help_outline</i> LAIN-LAIN
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Personal tab -->
                                    <div role="tabpanel" class="tab-pane fade in active" id="information_tab">
                                        <fieldset id="bankForm" disabled>
                                            <!-- id -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="id">ID</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="id" class="form-control" :value="bank.id" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- name -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="name">Nama Bank Sampah</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="name" class="form-control" :value="bank.name">
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
                                                            <input type="text" id="address" class="form-control" :value="bank.address">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- description -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="description">Deskripsi Bank Sampah</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea id="description" class="form-control no-resize" rows="4" :value="bank.description"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- active -->
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="active">Status</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group">
                                                        <input id="true" type="radio" value="1" class="with-gap radio-col-green" v-model="bank.active"/>
                                                        <label for="true">Aktif</label>
                                                        <input id="false" type="radio" value="0" class="with-gap radio-col-orange" v-model="bank.active"/>
                                                        <label for="false">Tidak aktif</label>
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
                                                            <input type="datetime" id="created_at" class="form-control" :value="momentDate(bank.created_at)" disabled>
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
                                                            <input type="datetime" id="updated_at" class="form-control" :value="momentDate(bank.updated_at)" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <!-- Password tab -->
                                    <div role="tabpanel" class="tab-pane fade" id="other_tab">
                                        
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

export default {
    data () {
        return {
            api: {
                show: 'api/sistem/bank/',
            },
            bank: {
                id: null
            },
        }
    },

    mounted () {
        this.getBank(this.api.show)
    },

    methods : {
        getBank(url) {
            this.$Progress.start()
            axios.get(url+this.$route.params.id)
            .then(response => {
                this.bank = response.data
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },

        momentDate(value) {
            return (value == null) 
            ? '' 
            : moment(value).locale('id').format('Do MMMM YYYY, HH:mm:ss')
        }
    }
}
</script>