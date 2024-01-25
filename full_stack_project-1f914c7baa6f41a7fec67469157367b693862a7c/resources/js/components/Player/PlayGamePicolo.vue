<template>
  <h1>Jouer une partie</h1>
  <label for="">picolo</label>
  <p>{{ picolos[i].text }}</p>
  <button :disabled='(i+1) == picolos.length' v-on:click="next(i)">Next</button>
</template>

<script>
import { authenticatedFetch } from "../../utils";
export default {
  data() {
    return {
      picolos: [],
      i: 0,
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
    next: function (i) {
      this.i += 1;
    },
  },

  created() {
    this.allPicolo();
  },
};
</script>

<style>
</style>
