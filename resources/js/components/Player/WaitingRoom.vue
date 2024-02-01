<template>
	<section class="waiting-room-container">
		<div class="player-card-container">
			<player-card
				v-for="(player, index) in players"
				:key="index"
				:playerName="player.name"
				:index="index + 1"
			/>
		</div>
		<button @click="redirect">Jouer</button>
		<!-- <router-link
			:to="{
				name: 'PlayGamePicolo',
				params: {
					difficultyId: this.$attrs.difficultyId,
					room: this.$attrs.room,
					gameId: this.$attrs.gameId,
				},
			}"
			>Jouer</router-link
		> -->
	</section>
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

		redirect: function () {

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

