<template>
	<div>
		<h1>Dashboard</h1>
		<router-link :to="{ name: 'CreateRoom' }">Créer un salon</router-link>
		<button @click.prevent="logout">Logout</button>
	</div>
</template>

<script>
export default {
	methods: {
		logout() {
			axios.post('/api/logout').then(() => {
				this.$router.push({ name: 'Home' })
			})
		}
	},
}
</script>

<style>
</style>
