<template>
    <router-link to="/">
        <p>Home</p>
    </router-link>
    <router-link to="/register">
        <p>register</p>
    </router-link>
    <router-link to="/login">
        <p>login</p>
    </router-link>
        

    
    <div class="rooter-view-container">
        <router-view></router-view>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>