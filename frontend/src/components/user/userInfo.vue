<template>
<div class="userInfo">
  <div class="nav-wrapper">
      <el-row class="tac">
        <el-col :span="12">
          <el-menu
            default-active="2"
            class="el-menu-vertical-demo"
            @open="handleOpen"
            @close="handleClose"
            background-color="#545c64"
            text-color="#fff"
            active-text-color="#ffd04b">
            <el-menu-item index="1">
                <i class="el-icon-location"></i>
                <span slot="title">我的信息</span>
            </el-menu-item>
            <el-menu-item index="2">
              <i class="el-icon-menu"></i>
              <span slot="title">我的活动</span>
            </el-menu-item>
          </el-menu>
        </el-col>
      </el-row>
  </div>
  <div class="user-wrapper">
        <div class="title">我的信息</div>
        <div class="division"></div>
        <div class="content">
            <div class="avatar"></div>
            <div class="main">
              <div class="username">用户名 ：{{userInfo.username}}</div>
              <div class="email">邮箱 ： {{userInfo.email}}</div>
              <div class="phone">手机 ： {{userInfo.phone}}</div>
              <div class="intro">简介 ： {{userInfo.intro}}</div>
            </div>
        </div>
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
  },
  methods: {
      handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }
  }
}
</script>

<style lang="stylus" rel="stylesheet/stylus">
.userInfo
    .nav-wrapper
        width: 300px
        margin: 50px 0 0 20px
        display: inline-block
        vertical-align: top
        .el-menu
            padding: 20px 0 20px 0
    .user-wrapper
        display: inline-block
        margin-top: 50px
        .division
            border: 1px rgba(213,213,213,0.6) solid
            margin-top: 10px
        .content
            margin-top: 20px
            .avatar
                background-image: url("avatar.jpg")
                background-size: 100px 100px
                width: 100px
                height: 100px
                vertical-align: top
            .main
                color: rgb(100,100,100)
                margin-top: 40px
                div 
                  margin-top: 20px


            
        
</style>
