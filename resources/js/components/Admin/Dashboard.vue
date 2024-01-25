<template>
	<section class="dashboard">
		<h1>Dashboard</h1>
		<table class="table">
			<tr>
				<th>Titre</th>
				<th>Ajouter</th>
				<th>Voir</th>
			</tr>

			<tr>
				<td>Mode</td>
				<td>
					<router-link
						class="btn btn-primary"
						:to="{ name: 'AdminAddMode' }"
					>
						Ajouter</router-link
					>
				</td>
				<td>
					<router-link
						class="btn btn-primary"
						:to="{ name: 'AdminAllModes' }"
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
