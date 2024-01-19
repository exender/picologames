<template>
	<h1>super admin dashboard</h1>
</template>

<script>
import { checkUser } from '../../utils'
export default {
	created() {
		checkUser()
	},
}
</script>

<style>
</style>
