<template>	
	<div class="container-fluid">
		<div class="row clearfix">
			<div class="col-xs-12">
				<!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-green">
                        <li><a><i class="material-icons">home</i> Beranda</a></li>
                        <li class="active"><i class="material-icons">account_balance</i> Bank Sampah Saya</li>
                    </ol>
                </div>
                <!-- Cek jika user tidak ada -->
	            <div v-if="!bank">
	                <div class="card">
	                    <div class="header">
	                        <h2>Bank Sampah Saya</h2>
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
					<!-- Foto bank (dari gravatar) -->
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
											<dt>Pemilik</dt>
											<dd>{{ bank.user.name }}</dd>
											<dt>Alamat</dt>
											<dd>{{ bank.address }}</dd>
										</dl>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<dl class="dl-horizontal dl-small m-b-0">
											<dt>Status</dt>
											<dd>{{ bank.active == true ? 'Aktif' : 'Tidak aktif' }}</dd>
											<dt>Bergabung Pada</dt>
											<dd>{{ momentDate(bank.created_at) }}</dd>
											<dt>Deskripsi</dt>
											<dd>{{ bank.description }}</dd>
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
			                                <i class="material-icons">account_balance</i> INFORMASI BANK
			                            </a>
			                        </li>
			                    </ul>
			                    <!-- Tab panes -->
			                    <div class="tab-content">
			                    	<!-- Personal tab -->
			                        <div role="tabpanel" class="tab-pane fade in active" id="personal_tab">
			                            <form class="form-horizontal" @submit.prevent="updateBank">
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
				                                            <label id="id-error" class="error" for="id">{{ error(errors.id) }}</label>
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
				                                                <input type="text" id="name" class="form-control" v-model="bank.name">
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
				                                                <input type="text" id="address" class="form-control" v-model="bank.address">
				                                            </div>
				                                            <label id="address-error" class="error" for="address">{{ error(errors.address) }}</label>
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
				                                            	<textarea id="description" class="form-control no-resize" rows="4" v-model="bank.description"></textarea>
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
			                                                <input id="true" type="radio" value="1" class="with-gap radio-col-green" v-model="bank.active"/>
									                        <label for="true">Aktif</label>
									                        <input id="false" type="radio" value="0" class="with-gap radio-col-orange" v-model="bank.active"/>
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
				                                                <input type="datetime" id="created_at" class="form-control" :value="momentDate2(bank.created_at)" disabled>
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
				                                                <input type="datetime" id="updated_at" class="form-control" :value="momentDate2(bank.updated_at)" disabled>
				                                            </div>
				                                            <label id="updated_at-error" class="error" for="updated_at">{{ error(errors.updated_at) }}</label>
				                                        </div>
				                                    </div>
				                                </div>
			                            	</fieldset>
			                            	<div class="row clearfix">
			                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" v-if="bankEditButton">
			                                        <button type="button" class="btn btn-danger m-t-15 waves-effect" @click="showBankEdit(false)">BATAL</button>
			                                        <button type="submit" class="btn btn-success m-t-15 waves-effect">SIMPAN</button>
			                                    </div>
			                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5" v-else>
			                                        <button type="button" class="btn btn-primary m-t-15 waves-effect" @click="showBankEdit(true)">EDIT</button>
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
                index: 'api/bank/my',
            },
        	bank: null,
        	password: {
        		password: null,
        		password_confirmation: null
        	},
        	response: null,
        	errors: [],
        	bankEditButton: false,
        	passwordEditButton: false
        }
    },

    mounted() {        
        this.getBank(this.api.index)
    },

    methods: {
        getBank(url) {
        	this.$Progress.start()
            axios.get(url).then(response => {
                this.bank = response.data
                this.$Progress.finish()
            }).catch(errors => {
                console.error(errors)
                this.$Progress.fail()
            })
        },

        updateBank() {
            this.$Progress.start()
            axios.put(this.api.index+'/'+this.bank.id, this.bank)
            .then(response => {
                if(response.data.success == true) {
                	this.response = response.data
                	this.$Progress.finish()
                	this.showBankEdit(false)
                	this.notify()
                    this.getBank(this.api.index)
                }
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
                this.errors = errors.response.data
                this.response = response.data
            })
        },

        showBankEdit(value) {
        	this.bankEditButton = value
        	if (value == true) {        		
        		$("#bankForm").removeAttr('disabled')
        	} else if (value == false) {
        		this.getBank(this.api.index)
        		$("#bankForm").attr('disabled', 'true')
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