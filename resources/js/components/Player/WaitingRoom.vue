<template>
	<section class="waiting-room-container">
		<div class="left-container-waiting-room">
			<router-link class="link-dashboard-wainting-room" :to="{ name: 'Dashboard' }">
				<div class="waiting-room-menu">
					<img
						src="/img/arrow-left.png"
						alt="Revenir à l'accueil"
						class="arrow-left"
					/>
					<div>Accueil</div>
				</div>
			</router-link>
			<div class="container-beer-players">
				<div v-if="players.length == 1" class="wait-players"> 
					En attente de joueurs supplémentaires ...
					<div class="animation-loader"></div>
				</div>
				<div v-else class="else-player-cards">
					<player-card
						v-for="(player, index) in players"
						:key="index"
						:playerName="player.name"
						:index="index + 1"
					/>
				</div>
			</div>
			<div
				v-if="players.length !== 0"
				class="container-parametre-parties"
			>
				<div>
					<input class="input-code"
						v-on:focus="$event.target.select()"
						ref="myinput"
						readonly
						:value="share"
						@click="shareCopy"
					/>
					<button class="btn-code" @click="shareCopy"> Copy </button>
				</div>
			</div>
							<div class="footer-piloco">
						<p>
							Piloco.fr <br> 
							Made with &#9829; - v1.0 
						</p>
					
				</div>
		</div>
		<div class="right-container-waiting-room">
			<div>
				<h1 class="text-align-center">Mode de jeu sélectionné :</h1>
				<p class="text-align-center">
					Désigne l’intensité d’alcool que vous allez ingurgez !
				</p>
			</div>

			<div class="container-mode-selection">
				<div class="button-game-mode-waiting-room">
					<img class="logo-mode" :src="mode.image" alt="" />
					<div class="txt-game-mode">{{ mode.name }}</div>
				</div>

				<router-link class="rootlink-modifier" :to="{ name: 'PlayGameMode' }">
					<div class="container-modifier-mode">
						<img
							class="modifier-mode"
							src="/img/modifier-mode.svg"
							alt="modifier le mode"
						/>
						<div>Modifier</div>
					</div>
				</router-link>
			</div>
			<div v-if="players.length !== 0">
				<button
					class="start-game"
					v-if="user == players[0].id"
					@click="redirect"
				>
					Lancer la partie
				</button>
			</div>
		</div>
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
			share: '',
			mode: {}
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
		},
		getMode: function () {
			authenticatedFetch(
				"GET",
				`/api/mode/show/${this.$attrs.difficultyId}/`
			).then((res) => {
				this.mode = res.data[0]
			})
		}
	},

	created() {
		this.getUser()
		this.getShareLink()
		this.getMode()

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

