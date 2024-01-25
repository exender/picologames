<template>
	<h1>All pilocos</h1>
	<table class="table">
		<tr>
			<th>id</th>
			<th>mode</th>
			<th>Text</th>
			<th>Gorgée</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>

		<tr v-for="piloco in pilocos" :key="piloco">
			<td>{{ piloco.id }}</td>
			<td>{{ getMode(piloco.mode) }}</td>
			<td>{{ piloco.text }}</td>
			<td>{{ piloco.sip }}</td>
			<td>
				<router-link
					class="btn btn-warning"
					:to="{ name: 'AdminEditPiloco', params: { id: piloco.id } }"
				>
					Modifier</router-link
				>
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
		deletePiloco: function (id) {
			authenticatedFetch('delete', `/api/picolo/delete/${id}`)
				.then((res) => {
					this.allPilocos()
				})
		},
		allPilocos: function () {
			authenticatedFetch('get', '/api/picolo/all')
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
			return this.modes.find(x => x.id == id).name
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
