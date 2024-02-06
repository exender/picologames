<template>
	<h1>Jouer une partie</h1>
	<label for="">picolo</label>
	<p v-if="picolos.length !== 0">{{ picolos[i].text }}</p>
	<button :disabled="i + 1 == picolos.length" @click="next(i)">Next</button>

	<div>
		<p v-for="player in players" :key="player">
			<player-card :playerName="player.name" />
		</p>
	</div>
</template>

<script>
import { authenticatedFetch } from "../../utils"
import PlayerCard from './PlayerCard.vue'
export default {
	components: { PlayerCard },

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
		next: function () {
			authenticatedFetch(
				"post",
				`/api/next`
			)
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
				if (this.user == this.players[0].id) {
					this.allPicolo()
				}



			})
		},
		getFirstQuestion: function (e) {
			if (this.players.length !== 0 && this.user !== this.players[0].id) {
				console.log(e)

				this.picolos = e[0]
				this.getGame()
			}
		}
	},

	created() {
		this.getUser()
	},
	mounted() {

		window.Echo.channel('play')
			.listen('Play', (e) => {
				this.getFirstQuestion(e)

			})
		window.Echo.channel('next')
			.listen('Next', (e) => {
				console.log(e)
				this.i += 1

			})


	},
};
</script>

<style>
</style>

