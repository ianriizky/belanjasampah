<template>
	<div>
		<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4 form-control-label">
			<label for="limit">Tampilkan jumlah data :</label>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-7 col-xs-7">
			<select class="form-control" id="limit" v-model="state.limit" @change.prevent="search">
				<option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				state: {
					limit: '5',
					keyword: ''
				},
				pagination: []
			}
		},

		mounted() {
			this.$bus.$on('pagination', data => {
				this.pagination = data
			})
			this.$bus.$on('keyword', data => {
				this.state.keyword = data
			})			
			this.$bus.$emit('limit', this.state.limit)
		},

		methods: {
			search() {
				this.$bus.$emit('limit', this.state.limit)
				this.$bus.$emit('search', this.state)
			}
		}
	}
</script>