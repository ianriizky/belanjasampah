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
                        <vuetable ref="vuetable"
                            api-url="/sistem/api/user"
                            :fields="fields"
                            pagination-path=""
                            :multi-sort="true"
                            :css="css.table"
                            @vuetable:pagination-data="onPaginationData"
                        ></vuetable>
                        <div class="vuetable-pagination row">
                            <div class="col-md-6">
                                <vuetable-pagination-info ref="paginationInfo"
                                    info-template="Menampilkan data {from} - {to} dari total {total} data"
                                    no-data-template="Data kosong"
                                ></vuetable-pagination-info>
                            </div>
                            <div class="col-md-6">
                                <vuetable-pagination ref="pagination"
                                    @vuetable-pagination:change-page="onChangePage"
                                    :css="css.pagination"
                                    :icons="css.icons"
                                ></vuetable-pagination>
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
import lodash from 'lodash'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VueEvents from 'vue-events'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'

Vue.use(VueEvents)

export default {
    components : {
        Vuetable,
        VuetablePagination,
        VuetablePaginationInfo
    },
    data () {
        return {
            fields: [
                {
                    name: '__sequence',
                    title: 'No.',
                    titleClass: 'text-center',
                    dataClass: 'text-center'
                },
                {
                    name: 'id',
                    title: 'ID'
                },
                {
                    name: 'name',
                    sortField: 'name',
                    title: 'Nama'                
                },
                {
                    name: 'email',
                    title: 'E-mail'
                },
                {
                    name: "roles[0].display_name",
                    title: 'Peran'
                },
                {
                    name: 'created_at',
                    title: 'Dibuat pada',
                    callback: 'formatDate'
                },
            ],
            css: {
                table: {
                    tableClass: 'table table-bordered table-striped table-hover',
                    loadingClass: 'loading',
                    ascendingIcon: 'glyphicon glyphicon-sort-by-attributes',
                    descendingIcon: 'glyphicon glyphicon-sort-by-attributes-alt',
                    handleIcon: 'glyphicon glyphicon-menu-hamburger',
                },
                pagination: {
                    infoClass: 'align-left',
                    wrapperClass: 'vuetable-pagination align-right',
                    activeClass: 'bg-indigo',
                    disabledClass: 'disabled',
                    pageClass: 'btn waves-effect',
                    linkClass: 'btn waves-effect',
                    icons: {
                        first: '',
                        prev: '',
                        next: '',
                        last: '',
                    },
                }
            },
        }
    },
    methods: {
        formatDate (value, fmt = 'DD MMMM YYYY') {
            return (value == null) 
            ? '' 
            : moment(value, 'YYYY-MM-DD').format(fmt)
        },
        getRolesDisplayName (value) {
            return _.get(value.id)
        },
        onPaginationData (paginationData) {
            this.$refs.pagination.setPaginationData(paginationData)
        },
        onChangePage (page) {
            this.$refs.vuetable.changePage(page)
        },
        onPaginationData (paginationData) {
            this.$refs.pagination.setPaginationData(paginationData)
            this.$refs.paginationInfo.setPaginationData(paginationData)
        },
    }
}
</script>