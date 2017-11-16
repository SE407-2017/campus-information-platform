<template>
<div class="header">
    <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect" background-color="#545c64" text-color="#fff" active-text-color="#ffd04b">
      <el-menu-item index="1" class="name" disabled>校园信息平台</el-menu-item>
      <!-- <el-menu-item index="2"></el-menu-item> -->
      <el-menu-item index="2">活动</el-menu-item>
      <div class="state">
          <el-menu-item index="3">登录</el-menu-item>
          <el-menu-item index="4">注册</el-menu-item>
          <el-menu-item index="5">注销</el-menu-item>
      </div>
    </el-menu>
</div>
</template>

<script>
export default {
  name: 'HelloWorld',
  data () {
    return {
       activeIndex: '2'
    }
  },
  methods: {
     handleSelect(key, keyPath) {
        console.log(key, keyPath);
      }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="stylus" rel="stylesheet/stylus">
@import url("//unpkg.com/element-ui@2.0.4/lib/theme-chalk/index.css");
.header
    margin-top: -60px
    .name
        font-size: 20px    
    .state
       float: right 
</style>
