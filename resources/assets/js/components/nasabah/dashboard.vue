<template>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12">
                <!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-blue-grey">
                        <li><a><i class="material-icons">home</i> Beranda</a></li>
                        <li class="active"><i class="material-icons">dashboard</i> Dashboard</li>
                    </ol>
                </div>
                <div class="card">
                    <div class="header">
                        <h2>
                            WELCOME
                        </h2>
                    </div>
                    <div class="body">
                        <div class="alert alert-success">
                            <strong>Selamat!</strong> Anda berhasil masuk ke halaman dashboard.
                            <br>
                            <strong>Saldo Anda : </strong>Rp{{ balance }}
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
                index: 'api/nasabah/saldo',
            },
            color: 'bg-blue-grey',
            balance: null,
        }
    },

    mounted () {
        this.getBalance(this.api.index)
    },

    methods: {
        getAllData(url) {
            this.params.keyword = null
            this.params.date = null
            this.getData(url)
        },

        getBalance(url) {
            this.$Progress.start()
            axios.get(url).then(response => {
                this.balance = response.data.balance
                this.$Progress.finish()
            }).catch(errors => {
                this.$Progress.fail()
                console.error(errors)
            })
        },
    }
}
</script>

<style>
@media (min-width: 768px) {
    .dl-horizontal.dl-small > dt {
        width: 120px;
    }
    .dl-horizontal.dl-small > dd {
        margin-left: 150px;
    }
}       
</style>