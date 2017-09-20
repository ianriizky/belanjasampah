<template>
	<div class="pagination-button" v-if="pagination.prev_page_url || pagination.next_page_url">
        <button type="button" class="btn waves-effect" :class="color" @click.prevent="load(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
            <i class="material-icons">fast_rewind</i>
        </button>
        <!-- <div class="btn-group" role="group" v-for="n in pagination.last_page">
            <button type="button" class="btn bg-indigo waves-effect" @click.prevent="loadCustom(n)" :disabled="n==pagination.current_page">{{ n }}</button>
        </div> -->
        <button type="button" class="btn waves-effect" :class="color" @click.prevent="load(pagination.next_page_url)" :disabled="!pagination.next_page_url">
            <i class="material-icons">fast_forward</i>
        </button>
    </div>
</template>

<script>
	export default {
		data() {
			return {
				pagination: [],
			}
		},

		props: ['color'],

		mounted() {
			this.$bus.$on('pagination', data => {
				this.pagination = data
			})			
		},

		methods: {
			load(url) {		
				console.log(url)		
				this.$bus.$emit('getData', url)
			},
		}
	}
</script>