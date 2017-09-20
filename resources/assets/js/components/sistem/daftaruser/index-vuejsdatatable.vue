<template>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
                                <h2>
                                    Master User
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
import moment from 'moment'

export default {
    components : {
        datatable
    },
    data() {
        return {
            api: {
                userIndex: 'sistem/api/user'
            },
            columns: [
                {label: 'ID', field: 'id', filterable: false},
                {label: 'Nama', field: 'name'},
                {label: 'E-mail', field: 'email'},
                {label: 'Peran', field: 'roles.id', sortable:false},
                {label: 'Status', sortable:false, callback: function(row){
                    return row.status == 'activated'
                    ? 'Aktif'
                    : (row == 'pending' ? 'Tidak aktif' : '');
                }},
                {label: 'Bergabung pada', callback: function(row, fmt = 'DD MMMM YYYY'){
                    return (row.created_at == null) 
                    ? '' 
                    : moment(row.created_at, 'YYYY-MM-DD').format(fmt)
                }}
            ],
            rows: []
        }
    },

    mounted() {
        this.$Progress.start();
        this.getUsers(this.api.userIndex)
    },

    methods: {
        getUsers(url) {
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