<template>
	<section class="auth-container">
		<h1>Connexion</h1>
		<form @submit.prevent="loginUser">
			<span v-if="this.form.loginExist" class="error-messages">
				Nous n'avons pas trouvé de compte, vérifier votre saisie.
			</span>
			<div class="form-group">
				<p v-for="error in errors" :key="error">
					{{ error }}
				</p>
				<label for="exampleInputEmail1">Email address</label>
				<input
					type="email"
					name="email"
					class="form-control"
					id="email"
					placeholder="Enter email"
					v-model="form.email"
					required
				/>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input
					type="password"
					name="password"
					class="form-control"
					id="exampleInputPassword1"
					placeholder="Password"
					v-model="form.password"
					required
				/>
			</div>

			<input
				type="submit"
				value="Se connecter"
				class="btn-connexion-inscription"
			/>
			<div class="mt-1">
				Pas de compte ?
				<router-link :to="{ name: 'Register' }">S'inscrire</router-link>
			</div>
		</form>
	</section>
</template>



<script>
export default {
	data() {
		return {
			form: {
				email: '',
				password: '',
				loginExist: false
			},
			errors: []
		}
	},
	methods: {
		loginUser: async function () {
			await axios.get('/sanctum/csrf-cookie').then(response => {
				axios.post('/api/login', this.form)
					.then((response) => {
						localStorage.name = response.data[0].name
						localStorage.token = response.data[2]
						this.$router.push({ name: 'Dashboard' })
					}).catch((error) => {
						this.form.loginExist = true
						// console.log(this.form.loginExist)
						this.errors = error.response.data.errors
					})
			})
		}
	}
}
</script>
