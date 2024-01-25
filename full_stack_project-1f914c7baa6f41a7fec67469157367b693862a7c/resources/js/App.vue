<template>
	<div class="rooter-view-container">
		<router-view></router-view>
	</div>
</template>

<script>


export default {
	mounted() {
		window.Echo.channel('channel')
			.listen('Hello', (e) => {
				console.log(e)
			})
	},
}
</script>

<style lang="scss">
@import "../sass/app.scss";
</style>
