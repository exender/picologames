<template>
	<section class="dashboard">
		<h1>Dashboard</h1>
		<table>
			<tr>
				<th>Titre</th>
				<th>Ajouter</th>
				<th>Modifier</th>
			</tr>

			<tr>
				<td>Mode</td>
				<td>
					<router-link :to="{ name: 'AdminAddMode' }">
						ajouter</router-link
					>
				</td>
				<td>
					<router-link :to="{ name: 'AdminAllModes' }"
						>modifier</router-link
					>
				</td>
			</tr>
		</table>
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
