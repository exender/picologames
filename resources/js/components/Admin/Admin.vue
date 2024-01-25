<template>
	<section class="admin-container">
		<router-view></router-view>
	</section>
</template>

<script>
import { checkAdmin } from '../../utils'
export default {
	created() {
		checkAdmin()
	},
}
</script>

<style>
</style>
