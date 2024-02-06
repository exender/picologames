<template>
	<div class="pop-up-container">
		<div
			@click="this.$emit('closePopUp')"
			class="fake-pop-up-container"
		></div>
		<div class="pop-up">
			<div class="chat-container">
				<div v-for="message in messages" :key="message">
					<span class="user-name-chat">{{
						getUser(message[0])
					}}</span>
					<p class="message-chat">{{ message[1] }}</p>
				</div>
				<form @submit.prevent="submit">
					<input type="text" v-model="msg" />
					<input type="submit" value="Envoyer" />
				</form>
			</div>
		</div>
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
			if (this.msg.length !== 0) {
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
