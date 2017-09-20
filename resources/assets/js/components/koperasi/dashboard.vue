<template>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12">
                <!-- Breadcumbs -->
                <div class="card">
                    <ol class="breadcrumb breadcrumb-col-red">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
export default {
    mounted() {
        this.$Progress.start();
        this.$Progress.finish();
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