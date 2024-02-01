<template>
	<div class="player-card">
		<img :src="`/img/beer${index}.svg`" alt="" />
		<p>{{ playerName }}</p>
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
