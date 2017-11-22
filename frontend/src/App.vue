<template>
  <div id="app">
    <vHeader></vHeader>
    <router-view class="test"/>
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

<style lang="stylus" rel="stylesheet/stylus">
body
    background-color: rgb(243,243,243)
</style>
