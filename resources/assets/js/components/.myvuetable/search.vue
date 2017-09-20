<template>
	<form @submit.prevent="search" method="post">
        <div class="col-xs-4 form-control-label">
            <label for="search">Cari :</label>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <div class="form-line">
                    <input v-model="state.keyword" type="text" class="form-control" placeholder="Masukkan kata kunci">
                </div>
            </div>
        </div>
        <div class="col-xs-2">
            <button type="submit" class="btn waves-effect" :class="color">
                <i class="material-icons">search</i>
            </button>
        </div>
    </form>
</template>

<script>
	export default {
		data() {
			return {
				state: {
					limit: '',
					keyword: ''
				}
			}
		},

		props: ['color'],

		mounted() {
			this.$bus.$on('limit', data => {
				this.state.limit = data
			})
			this.$bus.$emit('keyword', this.state.keyword)			
		},

		methods: {
			search() {
				this.$bus.$emit('keyword', this.state.keyword)
				this.$bus.$emit('search', this.state)
			}
		}
	}
</script>