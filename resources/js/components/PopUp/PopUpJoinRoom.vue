<template>
	<div class="pop-up-container">
		<div
			@click="this.$emit('closePopUp')"
			class="fake-pop-up-container"
		></div>
		<div class="pop-up">
			<h1>Rejoindre une partie</h1>
			<div>
				<input
					v-model="roomName"
					type="text"
					placeholder="Entrer le nom de la partie"
				/>
				<button @click="join">Rejoindre</button>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			roomName: ''
		}
	},
	methods: {
		join: function () {
			this.$router.push({ path: `waiting-room/${this.roomName}` })
		}
	},
}
</script>

<style>
</style>
