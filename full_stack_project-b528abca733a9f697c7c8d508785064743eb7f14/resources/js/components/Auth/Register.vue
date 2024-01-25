<template>
	<section class="auth-container">
		<form @submit.prevent="saveForm">
			<h1>Register</h1>
			<div class="form-group">
				<label for="exampleInputEmail1">Name</label>
				<input
					type="text"
					name="name"
					class="form-control"
					id="name"
					placeholder="Enter name"
					v-model="form.name"
				/>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Email address</label>
				<input
					type="email"
					name="email"
					class="form-control"
					id="email"
					placeholder="Enter email"
					v-model="form.email"
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
				/>
			</div>
			<div class="form-group">
				<label for="password_confirmation">Confirm Password</label>
				<input
					type="password"
					name="password_confirmation"
					class="form-control"
					id="password_confirmation"
					placeholder="Password"
					v-model="form.password_confirmation"
				/>
			</div>

			<button class="btn btn-primary">Submit</button>
			<router-link :to="{ name: 'Login' }">Se connecter</router-link>
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
				password_confirmation: ''
			},
			errors: []
		}
	},
	methods: {
		saveForm() {
			axios.post('/api/register', this.form).then(() => {
				this.$router.push({ name: 'Dashboard' })
			}).catch((error) => {
				this.errors = error.response.data.errors
			})
		}
	}
}
</script>

<style>
</style>
