<template>
	<div class="container-game">
		<div class="game-tchat">
			<img
				@click="
					popUp = !popUp;
					notif = false;
				"
				class="game-tchat-style"
				src="/img/message.png"
				alt=""
			/>
			<span v-if="notif">!</span>
		</div>
		<router-link class="link-dashboard" :to="{ name: 'Dashboard' }">
			<div class="menu">
				<img
					src="/img/arrow-left.png"
					alt="retour au menu"
					class="arrow-left"
				/>

				<div>Retour au menu</div>
			</div>
		</router-link>

		<p class="question-game" v-if="picolos.length !== 0 && !isEnded">
			<span>{{ players[i % players.length].name }}</span>
			{{ picolos[i].text }} <br />
			<button
				class="question-game-btn"
				v-if="players[i % players.length].id == user"
				@click="next(i)"
			>
				next
			</button>
		</p>
		<div class="question-game" v-if="isEnded">
			<p class="color-winner">
				La partie est terminé ! <br />
				Le gagnant est le plus arraché !
			</p>
			<router-link class="link-dashboard" :to="{ name: 'Dashboard' }">
				<button class="btn-link-dashboard">Revenir au menu !</button>
			</router-link>
		</div>

		<div class="container-players">
			Joueurs :
			<span v-for="player in players" :key="player">
				<player-card class="player-name" :playerName="player.name" />
			</span>
		</div>

		<div
			:style="`width: ${(i / picolos.length) * 100}%`"
			class="progression-bar"
		></div>
		<pop-up-chat
			@newMessage="notif = true"
			@closePopUp="popUp = !popUp"
			v-if="popUp"
			:players="players"
			:user="user"
			:gameId="gameId"
			:messages="messages"
		/>
	</div>
</template>

<script>
import { authenticatedFetch } from "../../utils"
import PopUpChat from '../PopUp/PopUpChat.vue'
import PlayerCard from './PlayerCard.vue'
export default {
	components: { PlayerCard, PopUpChat },

	data() {
		return {
			picolos: [],
			i: 0,
			user: null,
			players: [],
			isEnded: false,
			gameId: null,
			popUp: false,
			notif: false,
			messages: []
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
			const data = {
				id: this.$attrs.gameId
			}
			authenticatedFetch(
				"post",
				`/api/next`,
				data
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
				// console.log(e)

				this.picolos = e[0]
				this.getGame()
			}
		}
	},

	created() {
		this.getUser()
		this.gameId = this.$attrs.gameId
	},
	mounted() {

		window.Echo.channel('play')
			.listen('Play', (e) => {
				this.getFirstQuestion(e)

			})
		window.Echo.private(`next.${this.$attrs.gameId}`)
			.listen('Next', (e) => {
				if (this.i < this.picolos.length - 1) {
					this.i += 1
				} else {
					this.i += 1
					this.isEnded = true
				}
			})

		window.Echo.private(`msg.${this.gameId}`)
			.listen('Msg', (e) => {
				this.messages.push(e)
				if (this.messages[this.messages.length - 1][0] !== this.user && !this.popUp) {
					this.notif = true
				}

				if (this.messages.length >= 10) {
					this.messages.shift()
				}

			})


	},
};
</script>

<style lang="scss">
@import "../../../sass/app.scss";
</style>
