<template>
	<div class="container-beer" :style="`background-image: url('/img/beer${index}.svg')`">
		<span>{{ playerName }}</span>
	</div>
</template>

<script>
export default {
	props: {
		playerName: String,
		index: Number
	}
}
</script>

<style>
</style>
