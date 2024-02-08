<template>
	<h1>All pilocos</h1>
	<input type="text" placeholder="Chercher par text" v-model="filterText" />
	<select v-model="selectedMode" id="">
		<option selected :value="null">--------</option>
		<option v-for="mode in modes" :key="mode" :value="mode.id">
			{{ mode.name }}
		</option>
	</select>
	<input
		type="text"
		placeholder="Chercher par gorgée"
		v-model="selectedSip"
	/>
	<table class="table">
		<tr>
			<th>id</th>
			<th>mode</th>
			<th>Text</th>
			<th>Gorgée</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>

		<tr v-for="piloco in filteredList" :key="piloco">
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
			modes: [],
			filterText: '',
			selectedMode: null,
			selectedSip: ''
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
			let mode = this.modes.find(x => x.id == id)
			if (mode) {
				return mode.name
			}
		}
	},

	computed: {
		filteredList() {
			let pilocos = this.pilocos
			if (this.selectedMode !== null) {
				pilocos = pilocos.filter(e => e.mode == this.selectedMode)
			}
			if (this.selectedSip !== '') {
				pilocos = pilocos.filter(e => e.sip == this.selectedSip)
			}
			return pilocos.filter(piloco => {
				return piloco.text.toLowerCase().includes(this.filterText.toLowerCase())
			})
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
