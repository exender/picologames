<template>
	<div class="rooter-view-container" id="app" @mousemove="handleMouseMove">
		<router-view></router-view>
    <div v-if="popupVisible" class="popup">
      <img src="/img/giphy.gif" alt="Description alternative du GIF" width="300" />
    </div>
	</div>
</template>

<script>
export default {
  data() {
    return {
      popupVisible: false,
    };
  },
  methods: {
    handleMouseMove(event) {
      if (event.ctrlKey) {
        if (event.clientY < 50 && event.clientX > window.innerWidth - 50) {
          this.popupVisible = true;
					console.log('ici');
					console.error('ici');
        } else {
          this.popupVisible = false;
        }
      } else {
        this.popupVisible = false;
      }
    },
  },
}
</script>

<style lang="scss">
@import "../sass/app.scss";
#app {
  height: 100vh;
  position: relative;
}

.popup {
  position: fixed;
  top: 10px;
  right: 10px;
  padding: 10px;
  background-color: #fff;
  border: 1px solid #ccc;
}
</style>
