<template>
  <div id="app">
    <vHeader></vHeader>
    <router-view/>
  </div>
</template>

<script>
import vHeader from "./components/header/header";
export default {
  name: 'app',
  components: {
    vHeader
  }
}
</script>

<style>
#app {
  text-align: center;
  margin-top: 60px;
}
</style>
