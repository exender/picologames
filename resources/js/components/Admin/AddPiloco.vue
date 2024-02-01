<template>
	<form class="admin-form" @submit.prevent="submit">
		<h1>Add picolo</h1>
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
		<div class="mb-3">
			<label for="">Publié</label>
			<input
				class="form-control"
				type="integer"
				placeholder="0"
				v-model="form.published"
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
				mode: null,
				text: '',
				sip: null,
				published: 0
			},
			modes: [],
			status: null
		}
	},

	methods: {
		submit: function () {
			authenticatedFetch('POST', `/api/picolo/add`, this.form)
				.then((res) => {
					this.status = res.status
					setTimeout(() => {
						this.status = null
					}, 1000)
				})
		},
		allModes: function () {
			authenticatedFetch('get', '/api/mode/all')
				.then((res) => {
					this.modes = res.data
				})
		}
	},
	created() {
		this.allModes()
	},
}
</script>

<style>
</style>
