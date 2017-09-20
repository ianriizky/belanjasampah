<template>	
	<div class="container-fluid">
		<div class="row clearfix">
			<div class="col-xs-12">
				<!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-indigo" v-if="profil.roles[0].id == 1">
                        <li><a><i class="material-icons">account_box</i> Akun</a></li>
                        <li class="active"><i class="material-icons">person_pin</i> Profil</li>
                    </ol>
                    <ol class="breadcrumb breadcrumb-col-red" v-if="profil.roles[0].id == 2">
                        <li><a><i class="material-icons">account_box</i> Akun</a></li>
                        <li class="active"><i class="material-icons">person_pin</i> Profil</li>
                    </ol>
                    <ol class="breadcrumb breadcrumb-col-green" v-if="profil.roles[0].id == 3">
                        <li><a><i class="material-icons">account_box</i> Akun</a></li>
                        <li class="active"><i class="material-icons">person_pin</i> Profil</li>
                    </ol>
                    <ol class="breadcrumb breadcrumb-col-blue-grey" v-if="profil.roles[0].id == 4">
                        <li><a><i class="material-icons">account_box</i> Akun</a></li>
                        <li class="active"><i class="material-icons">person_pin</i> Profil</li>
                    </ol>
                </div>
                <!-- Cek jika user tidak ada -->
	            <div v-if="!profil">
	                <div class="card">
	                    <div class="header">
	                        <h2>Profil</h2>
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
					<!-- Foto Profil (dari gravatar) -->
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
						<a class="thumbnail card">
							<img :src="profil.picture" alt="User" class="img-responsive" width="150px">
						</a>
					</div>
					<!-- Data umum -->
					<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
						<div class="card">
							<div class="header">
								<h2>{{ profil.name }}</h2>
							</div>
							<div class="body">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<dl class="dl-horizontal dl-small m-b-0">
											<dt>ID</dt>
											<dd>{{ profil.id }}</dd>
											<dt>E-mail</dt>
											<dd>{{ profil.email }}</dd>
											<dt>Alamat</dt>
											<dd>{{ profil.address }}</dd>
										</dl>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<dl class="dl-horizontal dl-small m-b-0">
											<dt>Nomor Telepon</dt>
											<dd>{{ profil.phone_number }}</dd>
											<dt>Jenis Kelamin</dt>
											<dd>{{ profil.gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</dd>
											<dt>Tanggal Lahir</dt>
											<dd>{{ momentDate(profil.birth_date) }}</dd>
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
			                            <a href="#password_tab" data-toggle="tab">
			                                <i class="material-icons">vpn_key</i> PASSWORD
			                            </a>
			                        </li>
			                    </ul>
			                    <!-- Tab panes -->
			                    <div class="tab-content">
			                    	<!-- Personal tab -->
			                        <div role="tabpanel" class="tab-pane fade in active" id="personal_tab">
			                            <form class="form-horizontal" @submit.prevent="updateProfil">
			                            	<fieldset id="profilForm" disabled>
			                            		<!-- id -->
				                                <div class="row clearfix">
				                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				                                        <label for="id">ID</label>
				                                    </div>
				                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				                                        <div class="form-group">
				                                            <div class="form-line">
				                                                <input type="text" id="id" class="form-control" v-model="profil.id" readonly>
				                                            </div>
				                                            <label id="id-error" class="error" for="id">{{ error(errors.id) }}</label>
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
				                                                <input type="email" id="email" class="form-control" v-model="profil.email">
				                                            </div>
				                                            <label id="email-error" class="error" for="email">{{ error(errors.email) }}</label>
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
				                                                <input type="text" id="name" class="form-control" v-model="profil.name">
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
				                                                <input type="text" id="address" class="form-control" v-model="profil.address">
				                                            </div>
				                                            <label id="address-error" class="error" for="address">{{ error(errors.address) }}</label>
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
				                                                <input type="text" id="phone_number" class="form-control" v-model="profil.phone_number">
				                                            </div>
				                                            <label id="phone_number-error" class="error" for="phone_number">{{ error(errors.phone_number) }}</label>
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
			                                                <input id="laki" type="radio" value="male" class="with-gap radio-col-light-blue" v-model="profil.gender"/>
									                        <label for="laki">Laki-laki</label>
									                        <input id="perempuan" type="radio" value="female" class="with-gap radio-col-pink" v-model="profil.gender"/>
									                        <label for="perempuan">Perempuan</label>
				                                        </div>
				                                        <label id="gender-error" class="error" for="gender">{{ error(errors.gender) }}</label>
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
				                                                <input type="date" id="birth_date" class="form-control" v-model="profil.birth_date">
				                                            </div>
				                                            <label id="birth_date-error" class="error" for="birth_date">{{ error(errors.birth_date) }}</label>
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
				                                                <input type="datetime" id="created_at" class="form-control" :value="momentDate2(profil.created_at)" disabled>
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
				                                                <input type="datetime" id="updated_at" class="form-control" :value="momentDate2(profil.updated_at)" disabled>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
			                            	</fieldset>
			                            	<div class="row clearfix">
			                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" v-if="profilEditButton">
			                                        <button type="button" class="btn btn-danger m-t-15 waves-effect" @click="showProfilEdit(false)">BATAL</button>
			                                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SIMPAN</button>
			                                    </div>
			                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" v-else>
			                                        <button type="button" class="btn btn-primary m-t-15 waves-effect" @click="showProfilEdit(true)">EDIT</button>
			                                    </div>
			                                </div>
			                            </form>
			                        </div>
			                        <!-- Password tab -->
			                        <div role="tabpanel" class="tab-pane fade" id="password_tab">
			                            <form class="form-horizontal" @submit.prevent="updatePassword">
			                            	<fieldset id="passwordForm" disabled>
			                            		<!-- password -->
				                                <div class="row clearfix">
				                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				                                        <label for="password">Ganti Password</label>
				                                    </div>
				                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				                                        <div class="form-group">
				                                            <div class="form-line">
				                                                <input type="password" id="password" class="form-control" v-model="password.password">
				                                            </div>
				                                            <label id="password-error" class="error" for="password">{{ error(errors.password) }}</label>
				                                        </div>
				                                    </div>
				                                </div>
				                                <!-- password_confirmation -->
				                                <div class="row clearfix">
				                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
				                                        <label for="password_confirmation">Ulangi Password</label>
				                                    </div>
				                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
				                                        <div class="form-group">
				                                            <div class="form-line">
				                                                <input type="password" id="password_confirmation" class="form-control" v-model="password.password_confirmation">
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
			                            	</fieldset>
			                            	<div class="row clearfix">
			                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" v-if="passwordEditButton">
			                                        <button type="button" class="btn btn-danger m-t-15 waves-effect" @click="showPasswordEdit(false)">BATAL</button>
			                                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SIMPAN</button>
			                                    </div>
			                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" v-else>
			                                        <button type="button" class="btn btn-primary m-t-15 waves-effect" @click="showPasswordEdit(true)">EDIT</button>
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
                index: 'api/profil',
            },
        	profil: {
        		roles: [
        			{
        				id: null
        			}
        		]
        	},
        	password: {
        		password: null,
        		password_confirmation: null
        	},
        	response: null,
        	errors: [],
        	profilEditButton: false,
        	passwordEditButton: false
        }
    },

    mounted() {        
        this.getProfil(this.api.index)
    },

    methods: {
        getProfil(url) {
        	this.$Progress.start()
            axios.get(url).then(response => {
                this.profil = response.data
                this.$Progress.finish()
            }).catch(errors => {
                console.error(errors)
                this.$Progress.fail()
            })
        },

        updateProfil() {
            this.$Progress.start()
            axios.put(this.api.index+'/'+this.profil.id+'/profil', this.profil)
            .then(response => {
                if(response.data.success == true) {
                	this.response = response.data
                	this.$Progress.finish()
                	this.showProfilEdit(false)
                	this.notify()
                    this.getProfil(this.api.index)
                    this.reset()
                }
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
                this.errors = errors.response.data
                this.response = response.data
            })
        },

        updatePassword() {
        	this.$Progress.start()
            axios.put(this.api.index+'/'+this.profil.id+'/password', this.password)
            .then(response => {
                if(response.data.success == true) {
                    this.response = response.data
                    this.$Progress.finish()
                    this.showPasswordEdit(false)
                    this.notify()
                    this.reset()
                }
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
                this.errors = errors.response.data
                this.response = response.data
            })
        },

        showProfilEdit(value) {
        	this.profilEditButton = value
        	if (value == true) {        		
        		$("#profilForm").removeAttr('disabled')
        	} else if (value == false) {
        		this.getProfil(this.api.index)
        		$("#profilForm").attr('disabled', 'true')
        	}
        },

        showPasswordEdit(value) {
        	this.passwordEditButton = value
        	if (value == true) {
        		$("#passwordForm").removeAttr('disabled')
        	} else if (value == false) {
        		this.password.password = null,
        		this.password.password_confirmation = null,
        		$("#passwordForm").attr('disabled', 'true')
        	}
        },

        error(field) {
            return _.head(field)
        },

        reset() {
        	this.password.password 				= null
        	this.password.password_confirmation = null
	       	this.response 						= null
        	this.errors 						= []
        },

        momentDate(value) {
            return (value == null) 
            ? '' 
            : moment(value).locale('id').format('LL')
        },

        hideAlert() {
            $('#alert').hide()
            this.response = {}
            this.reset()
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