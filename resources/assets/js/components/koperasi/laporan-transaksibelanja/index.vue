<template>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
                                <h2>
                                    Laporan Riwayat Transaksi Belanja
                                </h2>                                
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                                <button type="button" class="btn btn-block btn-success waves-effect">TAMBAH</button>
                            </div>
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