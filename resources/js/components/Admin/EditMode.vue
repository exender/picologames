<template>
	<form @submit.prevent="submit">
		<div class="form-group">
			<label for="">Name</label>
			<input type="text" v-model="form.name" />
		</div>

		<input type="submit" />
		<p v-if="status !== null">
			{{
				status == 200
					? "Enregistré avec succés"
					: "Un probleme est survenu"
			}}
		</p>
	</form>
</template>

<script>
import { authenticatedFetch } from '../../utils'
export default {
	data() {
		return {
			form: {
				name: ''
			},
			status: null
		}
	},

	methods: {

		getMode: function () {
			authenticatedFetch('GET', `/api/mode/edit/${this.$route.params.id}`)
				.then((res) => {
					this.form = res.data
				})
		},
		submit: function () {
			authenticatedFetch('PUT', `/api/mode/update/${this.form.id}`, this.form)
				.then((res) => {
					this.status = res.status
					setTimeout(() => {
						this.status = null
					}, 1000)
				})
		}
	},
	created() {
		this.getMode()
	},
}
</script>

<style>
</style>
