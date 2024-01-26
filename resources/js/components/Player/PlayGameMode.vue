<template>
	<h1>Tous les modes Modes</h1>
	<table class="table">
		<tr>
			<th>Name</th>
			<th></th>
		</tr>

		<tr v-for="mode in modes" :key="mode">
			<td>{{ mode.name }}</td>
			<td>
				<button @click="submit" class="btn btn-warning">Jouer</button>
			</td>
		</tr>
	</table>
</template>

<script>
import { authenticatedFetch } from "../../utils"
export default {
	data() {
		return {
			modes: [],
			data: {
				roomId: '',
				playerId: parseInt(localStorage.token.substr(0, localStorage.token.indexOf('|')))
			}
		}
	},

	methods: {
		allModes: function () {
			authenticatedFetch("get", "/api/mode/all").then((res) => {
				this.modes = res.data
			})
		},

		submit: function () {

			authenticatedFetch("POST", "/api/create-game", this.data)
				.then(() => {
					this.$router.push({
						name: 'PlayGamePicolo', params: {
							id: mode.id,
							roomId: data.roomId,
						}
					})
				})
				.catch(error => {
					console.error(error)
				})
		}
	},

	created() {
		this.allModes()
		this.data.roomId = Math.floor((1 + Math.random()) * 0x10000)
			.toString(16)
			.substring(1)
	},
};
</script>

<style>
</style>
