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
		<div v-if="players.length !== 0">
			<button v-if="user == players[0].id" @click="redirect">
				Jouer
			</button>
			<input
				v-on:focus="$event.target.select()"
				ref="myinput"
				readonly
				:value="share"
				@click="shareCopy"
			/>
		</div>
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
			players: [],
			share: ''
		}
	},

	methods: {


		shareCopy: function () {
			this.$refs.myinput.focus()
			document.execCommand('copy')
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

			authenticatedFetch(
				"POST",
				`/api/redirect`
			)


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
		getShareLink: function () {
			let params = this.$route.params

			this.share = `${params.room}&${params.gameId}&${params.difficultyId}`
		}
	},

	created() {
		this.getUser()
		this.getShareLink()

	},
	mounted() {
		window.Echo.channel('channel')
			.listen('Test', (e) => {
				console.log(e)
				this.getGame()
			})

		window.Echo.channel('redirect')
			.listen('Redirect', (e) => {
				this.$router.push({
					name: 'PlayGamePicolo',
					params: {
						difficultyId: this.$attrs.difficultyId,
						room: this.$attrs.room,
						gameId: this.$attrs.gameId,
					}
				})
			})

	},
};
</script>

<style>
</style>

