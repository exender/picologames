<template>
	<h1>Jouer une partie</h1>
	<label for="">picolo</label>
	<p v-if="picolos.length !== 0">{{ picolos[i].text }}</p>
	<button :disabled="i + 1 == picolos.length" v-on:click="next(i)">
		Next
	</button>
</template>

<script>
import { authenticatedFetch } from "../../utils"
export default {

	data() {
		return {
			picolos: [],
			i: 0,
		}
	},

	methods: {
		allPicolo: function () {
			authenticatedFetch(
				"get",
				`/api/picolo/show/${this.$route.params.id}/`
			).then((res) => {
				this.picolos = res.data
			})
		},
		next: function (i) {
			this.i += 1
		},


		broadcast: function () {
			axios.post(`/api/play-game-picolo`, localStorage.token)
		}
	},

	created() {
		this.allPicolo()
		this.broadcast()
	},
};
</script>

<style>
</style>
