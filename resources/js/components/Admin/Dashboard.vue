<template>
	<h1>Dashboard</h1>
	<table class="table">
		<tr>
			<th>Titre</th>
			<th>Ajouter</th>
			<th>Voir</th>
		</tr>

		<tr>
			<td>Modes</td>
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
		<tr>
			<td>Pilocos</td>
			<td>
				<router-link
					class="btn btn-primary"
					:to="{ name: 'AdminAddPiloco' }"
				>
					Ajouter</router-link
				>
			</td>
			<td>
				<router-link
					class="btn btn-primary"
					:to="{ name: 'AdminAllPilocos' }"
					>Voir</router-link
				>
			</td>
		</tr>
		<tr>
			<td>Suggested Pilocos</td>
			<td></td>
			<td>
				<router-link
					class="btn btn-primary"
					:to="{ name: 'AdminAllSuggestedPilocos' }"
					>Voir</router-link
				>
			</td>
		</tr>
	</table>
</template>

<script>
export default {

}
</script>

<style>
</style>
