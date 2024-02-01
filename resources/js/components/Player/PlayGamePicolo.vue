<template>
	<h1>Jouer une partie</h1>
	<label for="">picolo</label>
	<p v-if="picolos.length !== 0">{{ picolos[i].text }}</p>
	<button :disabled="i + 1 == picolos.length" v-on:click="next(i)">
		Next
	</button>

	<div>
		<p v-for="player in players" :key="player">
			{{ player.email }}
		</p>
	</div>
</template>

<script>
import { authenticatedFetch } from "../../utils"
export default {

	data() {
		return {
			picolos: [],
			i: 0,
			user: null,
			players: []
		}
	},

	methods: {

		allPicolo: function () {
			authenticatedFetch(
				"get",
				`/api/picolo/show/${this.$attrs.difficultyId}/`
			).then((res) => {
				this.picolos = res.data
			})
		},
		next: function (i) {
			this.i += 1
		},

		getUser: async function () {
			let id = parseInt(localStorage.token.substr(0, localStorage.token.indexOf('|')))
			await authenticatedFetch('GET', `/api/token/${id}`)
				.then((res) => {
					authenticatedFetch('GET', `/api/user/${res.data}`).then((res) => {

						this.user = res.data.id
					})
						.finally(() => {
							this.broadcast()
						})
				})

		},


		broadcast: function () {

			const data = {
				gameId: this.$attrs.gameId,
				userId: this.user

			}
			authenticatedFetch(
				"POST",
				`/api/game-players`, data
			)
				.finally(() => {
					this.getGame()
				})


		},
		getGame: function () {
			authenticatedFetch(
				"GET",
				`/api/game-players/${this.$attrs.gameId}/`
			).then((res) => {
				this.players = res.data



			})
		},
	},

	created() {
		this.allPicolo()
		this.getUser()
	},
	mounted() {
		window.Echo.channel('channel')
			.listen('Test', (e) => {
				console.log(e)
				this.getGame()
			})

	},
};
</script>

<style>
</style>

