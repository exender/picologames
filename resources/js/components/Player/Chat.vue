<template>
	<div class="chat-container">
		<div v-for="message in messages" :key="message">
			<p>{{ getUser(message[0]) }}</p>
			<p>{{ message[1] }}</p>
		</div>
		<form @submit.prevent="submit">
			<input type="text" v-model="msg" />
			<input type="submit" value="Envoyer" />
		</form>
	</div>
</template>

<script>
import { authenticatedFetch } from "../../utils"
export default {
	props: {
		gameId: String,
		user: Number,
		players: Array
	},
	data() {
		return {
			msg: '',
			messages: []
		}
	},

	methods: {
		getUser: function (e) {
			const playerName = this.players.find(x => x.id == e)
			return playerName.name
		},
		submit: function () {
			const data = {
				msg: this.msg,
				user: this.user,
				gameId: this.gameId
			}
			authenticatedFetch(
				"post",
				`/api/msg`,
				data
			)
			this.msg = ''
		}
	},

	mounted() {
		window.Echo.private(`msg.${this.gameId}`)
			.listen('Msg', (e) => {
				console.log(e)
				this.messages.push(e)

				if (this.messages.length >= 10) {
					this.messages.shift()
				}

			})
	},
}
</script>

<style>
</style>
