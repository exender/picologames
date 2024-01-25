<template>
	<router-link to="/">
		<p>Home</p>
	</router-link>
	<router-link :to="{ name: 'Register' }">
		<p>register</p>
	</router-link>
	<router-link :to="{ name: 'Login' }">
		<p>login</p>
	</router-link>
	<router-view></router-view>
</template>

<script>
export default {

}
</script>

<style>
</style>
