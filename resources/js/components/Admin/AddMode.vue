<template>
	<form class="admin-form" @submit.prevent="submit">
		<h1>Add mode</h1>
		<div class="mb-3">
			<label for="">Name</label>
			<input class="form-control" type="text" v-model="form.name" />
		</div>

		<input class="btn btn-primary" type="submit" />
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
		submit: function () {
			authenticatedFetch('POST', `/api/mode/add`, this.form)
				.then((res) => {
					this.status = res.status
					setTimeout(() => {
						this.status = null
					}, 1000)
				})
		}
	},
}
</script>

<style>
</style>
