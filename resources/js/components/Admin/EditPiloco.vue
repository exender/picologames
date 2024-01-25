<template>
	<form class="admin-form" @submit.prevent="submit">
		<h1>Edit piloco</h1>
		<div class="mb-3">
			<label for="">Mode</label>
			<select
				v-if="modes.length !== 0"
				class="form-select form-control"
				v-model="form.mode"
			>
				<option value="" selected disabled hidden>
					--Choisir un mode--
				</option>
				<option v-for="mode in modes" :key="mode" :value="mode.id">
					{{ mode.name }}
				</option>
			</select>
		</div>
		<div class="mb-3">
			<label for="">Text</label>
			<textarea
				class="form-control"
				v-model="form.text"
				placeholder="Le texte"
			></textarea>
		</div>

		<div class="mb-3">
			<label for="">Gorgée</label>
			<input
				class="form-control"
				type="text"
				placeholder="3"
				v-model="form.sip"
			/>
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
			modes: [],
			status: null
		}
	},

	methods: {

		getPiloco: function () {
			authenticatedFetch('GET', `/api/picolo/edit/${this.$route.params.id}`)
				.then((res) => {
					this.form = res.data
				})
		},
		allModes: function () {
			authenticatedFetch('get', '/api/mode/all')
				.then((res) => {
					this.modes = res.data
				})
		},
		submit: function () {
			authenticatedFetch('PUT', `/api/picolo/update/${this.form.id}`, this.form)
				.then((res) => {
					this.status = res.status
					setTimeout(() => {
						this.status = null
					}, 1000)
				})
		}
	},
	created() {
		this.allModes()
		this.getPiloco()
	},
}
</script>

<style>
</style>
