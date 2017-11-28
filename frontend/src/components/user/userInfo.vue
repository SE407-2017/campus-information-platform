<template>
<div class="userInfo">
  <div class="user-wrapper">
        <div class="avatar"></div>
        <div class="username">用户名 ：{{userInfo.username}}</div>
        <div class="email">邮箱 ： {{userInfo.email}}</div>
        <div class="phone">手机 ： {{userInfo.phone}}</div>
        <div class="intro">简介 ： {{userInfo.intro}}</div>
        <div class="division"></div>
    </div>
</div>
</template>

<script>

export default {
  data(){
    return {
      userInfo: {}
    }
  },
  mounted: function(){
    var that = this;
    this.$axios.get('/api/user/detail/home')
    .then(function (response) {
        var userInfo = {}
        userInfo.username = response.data[0].username
        userInfo.email = response.data[0].email
        userInfo.phone = response.data[0].phone
        userInfo.intro = response.data[0].intro
        that.userInfo = userInfo
    })
    .catch(function (error) {
      console.log(error);
    });
  }
}
</script>

<style lang="stylus" rel="stylesheet/stylus">

        
</style>
