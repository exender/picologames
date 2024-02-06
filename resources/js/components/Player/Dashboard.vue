<template>
	<div>
		<div class="dashboard">
			<div class="piloco-presentation">
				<img
					class="logo-size"
					src="/img/logo.png"
					alt="logo de piloco"
				/>
				<div class="presentation-texte">
					Bienvenue <span class="name-player"> {{ name }} </span> ! <br> 
					Piloco est un jeu réalisé uniquement pour vous amuser en soirée !
				</div>

				<p v-if="name" class="name-questions" > <button @click="
							isPopUpQuestion = !isPopUpQuestion
						"> Proposer une question ?</button> </p>

				
				<button class="logout-btn" @click.prevent="logout">Logout</button>

			</div>
			<div class="game-create-start">
				<div class="h-50 position-relative flex-center-h-v">
					<img
						src="/img/creation-partie.png"
						alt="Créer la partie"
						class="img-creation-partie"
					/>
					<router-link class="link-to-join-game" :to="{ name: 'PlayGameMode' }">
						<div class="btn-partie btn-rejoindre-partie">
							Créer la partie
						</div>
					</router-link>
				</div>
				<div class="h-50 position-relative flex-center-h-v">
					<div
						@click="
							isPopUpJoinRoomVisible = !isPopUpJoinRoomVisible
						"
						class="btn-partie btn-creer-partie"
					>
						Rejoindre une partie
					</div>
					<img
						src="/img/rejoindre-partie.png"
						alt="Rejoindre une partie"
						class="img-rejoindre-partie"
					/>
				</div>
			</div>
		</div>
	</div>

	<pop-up-join-room
		@closePopUp="isPopUpJoinRoomVisible = !isPopUpJoinRoomVisible"
		v-if="isPopUpJoinRoomVisible"
	/>
	<pop-up-question @closePopUp="isPopUpQuestion = !isPopUpQuestion"
		v-if="isPopUpQuestion"/>
</template>

<script>
import { checkId } from '../../utils'
import PopUpJoinRoom from '../PopUp/PopUpJoinRoom.vue'
import PopUpQuestion from '../PopUp/PopUpQuestion.vue'
export default {
	components: { PopUpJoinRoom, PopUpQuestion },
	data() {
		return {
			id: null,
			isPopUpJoinRoomVisible: false,
			isPopUpQuestion: false,
			name: localStorage.name
		}
	},
	methods: {
		logout() {
			axios.post('/api/logout').then(() => {
				this.$router.push({ name: 'Home' })
			})
		},
		getId: function () {
			checkId().then((num) =>
				this.id = num
			)
		}
	},
	created() {
		this.getId()
	},
}
</script>

<style lang="scss">
@import "../../../sass/_variables.scss";

@media only screen and (max-width: 1000px) {
	.flex-center-h-v {
		flex-direction: column;
	}
	.img-creation-partie {
		width: 150px;
		position: initial !important;
	}
	.img-rejoindre-partie {
		width: 150px;
		position: initial !important;
	}
	.btn-rejoindre-partie {
		font-size: 1rem !important;
	}
	.btn-creer-partie {
		font-size: 1rem !important;
	}

	.dashboard {
		flex-direction: column;
		.game-create-start {
			width: 100% !important;
		}
	}
	.piloco-presentation {
		flex-direction: row !important;
		justify-content: space-around !important;
		width: 100% !important;
		padding: 10px;
	}
	.logo-size {
		width: 150px !important;
		margin-left: 0 !important;
		margin-right: 0 !important;
	}
	.presentation-texte {
		display: flex;
		justify-content: center;
		align-items: center;
		margin-left: 0 !important;
		margin-right: 0 !important;
		margin-top: 0 !important;
		font-size: 1rem !important;
	}
	.game-create-start {
		height: inherit;
	}
}

.dashboard {
	height: 100vh;
	display: flex;

	.btn-partie {
		padding: 10px 30px;
		width: fit-content;
	}

	.btn-rejoindre-partie {
		background-color: $blue;
		color: $white;
		font-size: 2rem;
		@include center-v-h;
	}

	.btn-creer-partie {
		cursor: pointer;
		background-color: $orange;
		color: $white;
		font-size: 2rem;
		@include center-v-h;
	}
	.piloco-presentation {
		background-color: $blue;
		width: 40%;
		@include center-v-h;
		flex-direction: column;

		.logo-size {
			width: fit-content;
			max-width: 80%;
			margin-left: auto;
			margin-right: auto;
		}

		.presentation-texte {
			text-align: center;
			margin-top: 40px;
			color: $white;
			font-size: 1.3rem;
			margin-left: 20px;
			margin-right: 20px;
		}
	}
	.game-create-start {
		padding: 50px;
		background-color: $white;
		width: 60%;
		@include center-v-h;
		flex-direction: column;
		align-items: center;

		.flex-center-h-v {
			@include center-v-h;
			align-items: center;
		}

		.position-relative {
			position: relative;
		}

		.img-creation-partie {
			position: absolute;
			right: 230px;
			top: 0;
			max-width: 200px;
		}

		.img-rejoindre-partie {
			position: absolute;
			right: -120px;
			bottom: 0;
			max-width: 200px;
			max-width: 200px;
		}
	}
}
</style>
