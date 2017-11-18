<template>
  <div class="detailActivity">
    <div class="main-wrapper">
        <div class="title"></div>
        <div class="avatar"></div>
        <div class="description"></div>
    </div>
    <div class="intro-wrapper">
        <div class="abstract"></div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'app',
  mounted: function() {
    console.log(this.$route.params.id)
  }
}
</script>

<style lang="stylus" rel="stylesheet/stylus">

</style>
