<template>
  <h1>Jouer une partie</h1>
  <label for="">picolo</label>
  <p v-for="picolo in picolos" :key="picolo" :value="picolo.id">
    {{ picolo.text }}
  </p>
</template>

<script>
import { authenticatedFetch } from "../../utils";
export default {
  data() {
    return {
      picolos: [],
    };
  },

  methods: {
    allPicolo: function () {
      authenticatedFetch(
        "get",
        `/api/picolo/show/${this.$route.params.id}`
      ).then((res) => {
        this.picolos = res.data;
      });
    },
  },

  created() {
    this.allPicolo();
  },
};
</script>

<style>
</style>
