<template>
	<div class="container-game" @click="next(i)" >
		<router-link class="link-dashboard" :to="{name: 'Dashboard'}"> 
	
			<div class="menu">
				<img src="/img/arrow-left.png" alt="retour au menu" class="arrow-left" />

				<div>
					Retour au menu
				</div>
			</div>
		</router-link>

		<p class="question-game" v-if="picolos.length !== 0 && !isEnded">{{ picolos[i].text }}</p>
		<div class="question-game" v-if="isEnded"> 
			<p class="color-winner"> La partie est terminer ! <br> Le gagnant est le plus arraché ! </p>
			<router-link class="link-dashboard" :to="{name: 'Dashboard'}"> 
				<button class="btn-link-dashboard"> Revenir au menu ! </button>
			</router-link>
		</div>

		<div class="container-players">
			Joueurs :
			<span v-for="player in players" :key="player">
				<player-card class="player-name" :playerName="player.name" />
			</span>	
		</div>

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
			players: [],
			isEnded: false
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
				if(this.i < this.picolos.length - 1) {
					this.i += 1
				}else{
					this.isEnded = true
				}
			})


	},
};
</script>

<style lang="scss">
	@import "../../../sass/app.scss";
</style>
