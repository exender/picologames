<template>
	<div class="pop-up-container">
		<div
			@click="this.$emit('closePopUp')"
			class="fake-pop-up-container"
		></div>
		<div class="pop-up">
			<h1>Rejoindre une partie</h1>
			<div class="container-join-input">
				<div>
					<input
						v-model="roomName"
						type="text"
						placeholder="Code de la partie"
						class="input-code-game"
					/>
					<button @click="join" class="btn-join">Rejoindre</button>
				</div>

				<span class="message-error"> {{ error }} </span>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			roomName: '',
			error: ''
		}
	},
	methods: {
		join: function () {
			if (this.roomName !== '') {
				this.$router.push({ path: `/waiting-room/${this.roomName}` })
			}
			else {
				this.error = "Insérer un nom de code valide !"
			}
		}
	},
}
</script>

<style>
</style>
