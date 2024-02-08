<template>
	<div class="pop-up-container">
		<div
			@click="this.$emit('closePopUp')"
			class="fake-pop-up-container"
		></div>
		<div class="pop-up pop-up-chat">
			<div class="chat-container">
				<div v-for="message in messages" :key="message">
					<div
						class="msg"
						:class="message[0] == user ? 'own-message' : ''"
					>
						<span class="user-name-chat">{{
							getUser(message[0])
						}}</span>
						<p class="message-chat">{{ message[1] }}</p>
					</div>
				</div>
				<form @submit.prevent="submit">
					<input
						class="message-sent"
						type="text"
						placeholder="message"
						v-model="msg"
					/>
					<input
						class="message-submit"
						type="submit"
						value="Envoyer"
					/>
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
		players: Array,
		messages: Array
	},
	data() {
		return {
			msg: '',
			newMessage: false
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

}
</script>

<style>
</style>
