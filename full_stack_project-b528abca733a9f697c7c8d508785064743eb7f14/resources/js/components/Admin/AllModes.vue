<template>
	<h1>All Modes</h1>
	<table class="table">
		<tr>
			<th>id</th>
			<th>Name</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>

		<tr v-for="mode in modes" :key="mode">
			<td>{{ mode.id }}</td>
			<td>{{ mode.name }}</td>
			<td>
				<router-link
					class="btn btn-warning"
					:to="{ name: 'AdminEditMode', params: { id: mode.id } }"
				>
					Modifier</router-link
				>
			</td>
			<td>
				<button class="btn btn-danger" @click="deleteMode(mode.id)">
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
			modes: []
		}
	},
	methods: {
		deleteMode: function (id) {
			authenticatedFetch('delete', `/api/mode/delete/${id}`)
				.then((res) => {
					this.allModes()
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
