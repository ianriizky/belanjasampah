<template>	
	<div class="container-fluid">
		<div class="row clearfix">
			<div class="col-xs-12">
				<!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-red">
                        <li><a><i class="material-icons">home</i> Beranda</a></li>
                        <li class="active"><i class="material-icons">store</i> Koperasi Serba Usaha Saya</li>
                    </ol>
                </div>
                <!-- Cek jika user tidak ada -->
	            <div v-if="!koperasi">
	                <div class="card">
	                    <div class="header">
	                        <h2>Koperasi Serba Usaha Saya</h2>
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
	            <!-- Cek jika user ada -->
				<div v-else>
					<!-- Foto koperasi (dari gravatar) -->
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
						<a class="thumbnail card">
							<img :src="koperasi.picture" alt="User" class="img-responsive" width="150px">
						</a>
					</div>
					<!-- Data umum -->
					<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
						<div class="card">
							<div class="header">
								<h2>{{ koperasi.name }}</h2>
							</div>
							<div class="body">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<dl class="dl-horizontal dl-small m-b-0">
											<dt>ID</dt>
											<dd>{{ koperasi.id }}</dd>
											<dt>Pemilik</dt>
											<dd>{{ koperasi.user.name }}</dd>
											<dt>Alamat</dt>
											<dd>{{ koperasi.address }}</dd>
										</dl>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<dl class="dl-horizontal dl-small m-b-0">
											<dt>Status</dt>
											<dd>{{ koperasi.active == true ? 'Aktif' : 'Tidak aktif' }}</dd>
											<dt>Bergabung Pada</dt>
											<dd>{{ momentDate(koperasi.created_at) }}</dd>
											<dt>Deskripsi</dt>
											<dd>{{ koperasi.description }}</dd>
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
			                                <i class="material-icons">store</i> INFORMASI KOPERASI
			                            </a>
			                        </li>
			                    </ul>
			                    <!-- Tab panes -->
			                    <div class="tab-content">
			                    	<!-- Personal tab -->
			                        <div role="tabpanel" class="tab-pane fade in active" id="personal_tab">
			                            <form class="form-horizontal" @submit.prevent="updateKoperasi">
			                            	<fieldset id="koperasiForm" disabled>
			                            		<!-- id -->
				                                <div class="row clearfix">
				                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				                                        <label for="id">ID</label>
				                                    </div>
				                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				                                        <div class="form-group">
				                                            <div class="form-line">
				                                                <input type="text" id="id" class="form-control" :value="koperasi.id" readonly>
				                                            </div>
				                                            <label id="id-error" class="error" for="id">{{ error(errors.id) }}</label>
				                                        </div>
				                                    </div>
				                                </div>
				                                <!-- name -->
				                                <div class="row clearfix">
				                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				                                        <label for="name">Nama Koperasi Serba Usaha</label>
				                                    </div>
				                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				                                        <div class="form-group">
				                                            <div class="form-line">
				                                                <input type="text" id="name" class="form-control" v-model="koperasi.name">
				                                            </div>
				                                            <label id="name-error" class="error" for="name">{{ error(errors.name) }}</label>
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
				                                                <input type="text" id="address" class="form-control" v-model="koperasi.address">
				                                            </div>
				                                            <label id="address-error" class="error" for="address">{{ error(errors.address) }}</label>
				                                        </div>
				                                    </div>
				                                </div>
				                                <!-- description -->
				                                <div class="row clearfix">
				                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				                                        <label for="description">Deskripsi koperasi Serba Usaha</label>
				                                    </div>
				                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				                                        <div class="form-group">
				                                            <div class="form-line">
				                                            	<textarea id="description" class="form-control no-resize" rows="4" v-model="koperasi.description"></textarea>
				                                            </div>
				                                            <label id="description-error" class="error" for="description">{{ error(errors.description) }}</label>
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
			                                                <input id="true" type="radio" value="1" class="with-gap radio-col-green" v-model="koperasi.active"/>
									                        <label for="true">Aktif</label>
									                        <input id="false" type="radio" value="0" class="with-gap radio-col-orange" v-model="koperasi.active"/>
									                        <label for="false">Tidak aktif</label>
				                                        </div>
				                                        <label id="active-error" class="error" for="active">{{ error(errors.active) }}</label>
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
				                                                <input type="datetime" id="created_at" class="form-control" :value="momentDate2(koperasi.created_at)" disabled>
				                                            </div>
				                                            <label id="created_at-error" class="error" for="created_at">{{ error(errors.created_at) }}</label>
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
				                                                <input type="datetime" id="updated_at" class="form-control" :value="momentDate2(koperasi.updated_at)" disabled>
				                                            </div>
				                                            <label id="updated_at-error" class="error" for="updated_at">{{ error(errors.updated_at) }}</label>
				                                        </div>
				                                    </div>
				                                </div>
			                            	</fieldset>
			                            	<div class="row clearfix">
			                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" v-if="koperasiEditButton">
			                                        <button type="button" class="btn btn-danger m-t-15 waves-effect" @click="showKoperasiEdit(false)">BATAL</button>
			                                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SIMPAN</button>
			                                    </div>
			                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" v-else>
			                                        <button type="button" class="btn btn-primary m-t-15 waves-effect" @click="showKoperasiEdit(true)">EDIT</button>
			                                    </div>
			                                </div>
			                            </form>
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
    data() {
        return {
        	api: {
                index: 'api/koperasi/my',
            },
        	koperasi: null,
        	password: {
        		password: null,
        		password_confirmation: null
        	},
        	response: null,
        	errors: [],
        	koperasiEditButton: false,
        	passwordEditButton: false
        }
    },

    mounted() {        
        this.getKoperasi(this.api.index)
    },

    methods: {
        getKoperasi(url) {
        	this.$Progress.start()
            axios.get(url).then(response => {
                this.koperasi = response.data
                this.$Progress.finish()
            }).catch(errors => {
                console.error(errors)
                this.$Progress.fail()
            })
        },

        updateKoperasi() {
            this.$Progress.start()
            axios.put(this.api.index+'/'+this.koperasi.id, this.koperasi)
            .then(response => {
                if(response.data.success == true) {
                	this.response = response.data
                	this.$Progress.finish()
                	this.showKoperasiEdit(false)
                	this.notify()
                    this.getKoperasi(this.api.index)
                }
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
                this.errors = errors.response.data
                this.response = response.data
            })
        },

        showKoperasiEdit(value) {
        	this.koperasiEditButton = value
        	if (value == true) {        		
        		$("#koperasiForm").removeAttr('disabled')
        	} else if (value == false) {
        		this.getKoperasi(this.api.index)
        		$("#koperasiForm").attr('disabled', 'true')
        	}
        },

        error(field) {
            return _.head(field)
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

        hideAlert() {
            $('#alert').hide()
            this.response = {}
            this.reset()
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
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
            })
        }
    }
}
</script>