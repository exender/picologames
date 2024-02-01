<template>
	<h1>All suggested pilocos</h1>
	<table class="table">
		<tr>
			<th>id</th>
			<th>mode</th>
			<th>Text</th>
			<th>Gorgée</th>
			<th>Publié</th>
			<th>Approuver</th>
			<th>Supprimer</th>
		</tr>

		<tr v-for="piloco in pilocos" :key="piloco">
			<td>{{ piloco.id }}</td>
			<td>{{ getMode(piloco.mode) }}</td>
			<td>{{ piloco.text }}</td>
			<td>{{ piloco.sip }}</td>
			<td>{{ piloco.published }}</td>
			<td>
				<button class="btn btn-success" @click="validate(piloco.id)">
					Approuver
				</button>
			</td>
			<td>
				<button class="btn btn-danger" @click="deletePiloco(piloco.id)">
					Supprimer
				</button>
			</td>
		</tr>
	</table>
</template>

<script>
import { authenticatedFetch } from '../../utils'
export default {
	data() {
		return {
			pilocos: [],
			modes: []
		}
	},
	methods: {

		validate: function (e) {
			authenticatedFetch('put', `/api/picolo/validate/${e}`)
				.then((res) => {
					this.allPilocos()
				})
		},
		deletePiloco: function (id) {
			authenticatedFetch('delete', `/api/picolo/delete/${id}`)
				.then((res) => {
					this.allPilocos()
				})
		},
		allPilocos: function () {
			authenticatedFetch('get', '/api/picolo/all-suggested')
				.then((res) => {
					this.pilocos = res.data
				})
		},
		allModes: function () {
			authenticatedFetch('get', '/api/mode/all')
				.then((res) => {
					this.modes = res.data
				})
		},
		getMode: function (id) {
			let mode = this.modes.find(x => x.id == id)
			if (mode) {
				return mode.name
			}
		}
	},
	created() {
		this.allModes()
		this.allPilocos()
	},
}
</script>

<style>
</style>
