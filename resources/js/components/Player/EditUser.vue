<template>
	<section class="auth-container">
		<form @submit.prevent="submit">
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

			<input class="btn btn-primary" type="submit" />
			<p v-if="status !== null">
				{{
					status == 200
						? "Enregistré avec succés"
						: "Un probleme est survenu"
				}}
			</p>
		</form>
	</section>
</template>

<script>
import { authenticatedFetch, checkId } from '../../utils'
export default {
	data() {
		return {
			form: {
				name: '',
				email: '',
				password: '',
				password_confirmation: ''
			},
			errors: [],
			status: null,
			id: null
		}
	},
	methods: {
		submit: function () {
			authenticatedFetch('PUT', `/api/user/update/${this.$route.params.id}`, this.form)
				.then((res) => {
					this.status = res.status
					setTimeout(() => {
						this.status = null
					}, 1000)
				})
		},
		getUser: function () {
			authenticatedFetch('GET', `/api/user/edit/${this.$route.params.id}`)
				.then((res) => {
					this.form = res.data
				})
		},
		getId: function () {
			checkId().then((num) =>
				this.id = num
			)
		}
	},
	created() {
		this.getUser()
		this.getId()
		// console.log('test', this.id)
	},
}
</script>

<style>
</style>
