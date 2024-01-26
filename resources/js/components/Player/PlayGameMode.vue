<template>
  <h1>Tous les modes Modes</h1>
  <table class="table">
    <tr>
      <th>Name</th>
      <th>Jouer</th>
    </tr>

    <tr v-for="mode in modes" :key="mode">
      <td>{{ mode.name }}</td>
      <td>
        <router-link
          class="btn btn-warning"
          :to="{ name: 'PlayGamePicolo', params: { id: mode.id } }"
        >
          Jouer</router-link
        >
      </td>
    </tr>
  </table>
</template>

<script>
import { authenticatedFetch } from "../../utils";
export default {
  data() {
    return {
      modes: [],
    };
  },

  methods: {
    allModes: function () {
      authenticatedFetch("get", "/api/mode/all").then((res) => {
        this.modes = res.data;
      });
    },
  },

  created() {
    this.allModes();
  },
};
</script>

<style>
</style>
