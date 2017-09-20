<template>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
                                <h2>
                                    Master Koperasi Serba Usaha
                                </h2>                                
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                                <button type="button" class="btn btn-block btn-success waves-effect">TAMBAH</button>
                            </div>
                        </div>                                                   
                    </div>
                    <div class="body">
                        <datatable :columns="columns" :data="rows" filterable paginate></datatable>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</template>

<script>
import datatable from 'vuejs-datatable'

export default {
    components : {
        datatable
    },
    data() {
        return {
            api: {
                koperasiIndex: 'sistem/api/koperasi'
            },
            columns: [
                {label: 'ID', field: 'id', filterable: false},
                {label: 'Nama', field: 'name'},
                {label: 'Alamat', field: 'address'},
                {label: 'Status', sortable:false, callback: function(row){
                    return row.active == 'y'
                    ? 'Aktif'
                    : (row == 'n' ? 'Tidak aktif' : '');
                }},
            ],
            rows: []
        }
    },

     mounted() {
        this.$Progress.start();
        this.getKoperasis(this.api.koperasiIndex)
    },

    methods: {
        getKoperasis(url) {
            axios.get(url).then(response => {
                this.rows = response.data;
                this.$Progress.finish();
            }).catch(errors => {
                console.error(errors);
                this.$Progress.fail();
            })
        },
    }
}
</script>