<template>
	<section class="dashboard">
		<h1>Dashboard</h1>
		<table>
			<tr>
				<th>Titre</th>
				<th>Ajouter</th>
				<th>Voir</th>
			</tr>

			<tr>
				<td>Mode</td>
				<td>
					<router-link :to="{ name: 'AdminAddMode' }">
						Ajouter</router-link
					>
				</td>
				<td>
					<router-link :to="{ name: 'AdminAllModes' }"
						>Voir</router-link
					>
				</td>
			</tr>
		</table>
	</section>
</template>

<script>
export default {

}
</script>

<style>
</style>
