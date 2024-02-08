<template>
	<div class="btn-annuler">
		<button> <router-link :to="{ name: 'Dashboard' }"> annuler</router-link>
		</button>
	</div>
	<section class="auth-container">
		<h1>Rejoindre la team Piloco !</h1>
		<form @submit.prevent="saveForm" class="mt-3">
			<span v-if="this.form.mdpCorrespondPas" class="error-messages">
				Tu es déja bourré ? Le mot de passe ne correspond pas...
			</span>
			{{ this.mdpCorrespondPas }}
			<div class="name-email">
				<div class="form-group">
					<label for="exampleInputEmail1">Nom</label>
					<input type="text" name="name" class="form-control" id="name" placeholder="Votre nom"
						v-model="form.name" required />
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Email</label>
					<input type="email" name="email" class="form-control" id="email" placeholder="Adresse email"
						v-model="form.email" required />
				</div>
			</div>
			<div class="password-password-confirm">
				<div class="form-group">
					<label for="exampleInputPassword1">Mot de passe</label>
					<input type="password" name="password" class="form-control" id="exampleInputPassword1"
						placeholder="Mot de passe" minlength="8" v-model="form.password" required />
				</div>
				<div class="form-group">
					<label for="password_confirmation">Confirmer le mot de apsse</label>
					<input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
						placeholder="Confirmation mot de passe" minlength="8" v-model="form.password_confirmation"
						required />
				</div>
			</div>

			<button class="btn-connexion-inscription">S'inscrire</button>
			<div class="mt-1">
				Déja un compte ?
				<router-link :to="{ name: 'Login' }">Se connecter</router-link>
			</div>
		</form>
	</section>
</template>

<script>
export default {
	data() {
		return {
			form: {
				name: '',
				email: '',
				password: '',
				password_confirmation: '',
				mdpCorrespondPas: false
			},
			errors: [],
		}
	},
	methods: {
		saveForm() {
			if (this.form.password === this.form.password_confirmation) {
				axios.post('/api/register', this.form)
					.then((res) => {
						// console.log(res)
						localStorage.name = res.data[0].name
						localStorage.token = res.data[2]
						this.$router.push({ name: 'Dashboard' })
					}).catch((error) => {
						console.error(error.response.data.errors)
					})
			}
			else {
				this.form.mdpCorrespondPas = true
			}
		}
	}
}
</script>

<style></style>
