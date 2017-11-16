<template>
<div class="header">
    <div class="header-wrapper">
        <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal"  background-color="#545c64" text-color="#fff" active-text-color="#ffd04b">
          <div class="title-wrapper">
            <el-menu-item index="1" @click.prevent.self class="title">校园信息平台</el-menu-item>
          </div>
          <!-- <el-menu-item index="2"></el-menu-item> -->
          <div class="menu-wrapper">
            <el-menu-item index="2">活动</el-menu-item>
          </div>
          <div class="search-wrapper">
              <el-input v-model="input" placeholder="请输入内容"></el-input>
          </div>
          <div class="state-wrapper">
              <el-menu-item index="3" @click="login">登录</el-menu-item>
              <el-menu-item index="4">注册</el-menu-item>
              <el-menu-item index="5">注销</el-menu-item>
          </div>
        </el-menu>
    </div>

    <div class="loginform-wrapper" v-show="clickToLogin">
        <el-form ref="form" :model="form" label-width="80px">
            <el-form-item label="用户名">
                <el-input v-model="form.username"></el-input>
            </el-form-item>
            <el-form-item label="密码">
                <el-input v-model="form.password"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">登录</el-button>
                <el-button>取消</el-button>
            </el-form-item>
        </el-form>
    </div>

</div>
</template>

<script>
export default {
  name: 'HelloWorld',
  data () {
    return {
       activeIndex: '2',
       input: "",
       clickToLogin: false,
       form: {
          username: "",
          password: ""
        }
    }
  },
  methods: {
    login: function() {
        this.clickToLogin = true;
    },
    onSubmit() {
        this.$axios.get('/api/user/login',{
            params: {
                username: this.form.username,
                password: this.form.password
            }
        })
        .then(function (response) {
           if(response.data.status == 1){
                alert("login succeed")
           }
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="stylus" rel="stylesheet/stylus">
@import url("//unpkg.com/element-ui@2.0.4/lib/theme-chalk/index.css");
.header
    position: relative
    .header-wrapper
        margin-top: -60px
        .title-wrapper
            display: inline-block
            float: left
            .title
                font-size: 20px    
        .menu-wrapper
            display: inline-block
            float: left
        .search-wrapper
            display: inline-block
            margin-top: 10px

        .state-wrapper
           display: inline-block
           float: right 
    .loginform-wrapper
        position: relative
        top: 100px
        margin: auto auto
        width: 50%
        z-index: 2
        
</style>
