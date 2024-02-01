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
				<button @click="submit(mode.id)" class="btn btn-warning">
					Jouer
				</button>
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
				room: null,
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

		submit: function (e) {

			authenticatedFetch("POST", "/api/create-game", this.data)
				.then((res) => {
					console.log(res)
					this.$router.push({
						name: 'WaitingRoom', params: {
							difficultyId: e,
							room: this.data.room,
							gameId: res.data
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
		this.data.room = Math.floor((1 + Math.random()) * 0x10000)
			.toString(16)
			.substring(1)
	},
};
</script>

<style>
</style>
