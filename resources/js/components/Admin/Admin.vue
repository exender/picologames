<template>
	<router-view></router-view>
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
