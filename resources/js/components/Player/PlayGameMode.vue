<template>
	<div class="container-game-mode">
		<h1> MODE DE JEU : </h1>
		<p> Désigne l'intensité dalcool que vous allez ingurgez ! </p>
		<div class="flex-align">
			<div v-for="(mode, index) in modes" :key="index" class="game-mode">
				<div @click="submit(mode.id)"
				
				class="button-game-mode"> 
					<img class="logo-mode" :src="mode.image" alt="">
					<div class="txt-game-mode"> {{mode.name}} </div>
				</div>
			</div>	
		</div>
	</div>

</template>

<style lang="scss">
	@import "../../../sass/_variables.scss";

	.flex-align{
		margin-top: 2rem;
		display: flex;
	}

	.lancer-partie{
		background-color: $orange;
		margin-top: 40px;
		border: 0px;
		color: $white;
		padding: 5px 40px;
		border-radius: 5px;
		transition: 0.2s;
	}

	.lancer-partie:hover{
		background-color: $orange;
		margin-top: 40px;
		border: 0px;
		color: $white;
		padding: 5px 40px;
		border-radius: 5px;
		font-size: 1.1rem;
		transition: 0.2s;
	}

	.txt-game-mode{
		background-color: $white;
		color: $black;
		margin-top: 20px;
		width: 100%;
		text-align: center;
	}

	.container-game-mode{
		height: 100vh;
		background-color: $blue;
		color: $white;
		@include center-v-h;
		flex-direction: column;
		align-items: center;
	}

	.game-mode{
		display: flex;
		justify-content: inherit;
		height: 170px;

	}
	
	.button-game-mode{
		min-height: 150px;
		border-radius: 5px;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		margin: 0px 30px;
		max-width: 150px;
		width: 130px;
		background-color: $orange;
		transition: 0.2s;
		cursor: pointer;
	}

	.button-game-mode:hover{
		transform: scale(1.1);
		transition: 0.2s;
		cursor: pointer;
	}

	.logo-mode{
		width: 50%;
	}
	.selectGame{
		border: 4px solid $black;
		transform: scale(1.1);
	}
</style>

<script>
import { authenticatedFetch } from "../../utils"

export default {
	data() {
		return {
			modes: [],
			data: {
				room: null,
				playerId: parseInt(localStorage.token.substr(0, localStorage.token.indexOf('|')))
			}
		}
	},

	methods: {
		allModes: function () {
			authenticatedFetch("get", "/api/mode/all").then((res) => {
				this.modes = res.data
			})
		},

		submit: function (e) {

			authenticatedFetch("POST", "/api/create-game", this.data)
				.then((res) => {
					console.log(res)
					this.$router.push({
						name: 'WaitingRoom', params: {
							difficultyId: e,
							room: this.data.room,
							gameId: res.data
						}
					})
				})
				.catch(error => {
					console.error(error)
				})
		},
	},

	created() {
		this.allModes()
		this.data.room = Math.floor((1 + Math.random()) * 0x10000)
			.toString(16)
			.substring(1)
	},
};
</script>
