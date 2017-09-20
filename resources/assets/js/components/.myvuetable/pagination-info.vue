<template>
    <p class="text-right">Menampilkan data <b>{{ pagination.from }} - {{ pagination.to }}</b> dari <b>{{ pagination.total }} data</b></p>
</template>

<script>
	export default {
		data() {
			return {
				pagination : []
			}
		},

		mounted() {
			this.$bus.$on('pagination', data => {
				this.pagination = data
			})
		}
	}
</script>