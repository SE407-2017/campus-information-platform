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
              <el-menu-item index="3" @click="clickToLogin">{{userState}}</el-menu-item>
              <el-menu-item index="5" v-show="isLogin" @click="clickToLogout">注销</el-menu-item>
              <el-menu-item index="4" @click="clickToSignup">注册</el-menu-item>
              <el-menu-item index="4" @click="testapi">测试</el-menu-item>
          </div>
        </el-menu>
    </div>

    <div class="loginform-wrapper" v-show="login">
        <el-form ref="form" :model="loginform" label-width="80px">
            <el-form-item label="用户名">
                <el-input v-model="loginform.username"></el-input>
            </el-form-item>
            <el-form-item label="密码">
                <el-input v-model="loginform.password"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onLoginSubmit">登录</el-button>
                <el-button @click="cancelLogin">取消</el-button>
            </el-form-item>
        </el-form>
    </div>

    <div class="signupform-wrapper" v-show="signup">
        <el-form ref="form" :model="signupform" label-width="80px">
            <el-form-item label="用户名">
                <el-input v-model="signupform.username"></el-input>
            </el-form-item>
            <el-form-item label="密码">
                <el-input v-model="signupform.password"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSignupSubmit">注册</el-button>
                <el-button @click="cancelSignup">取消</el-button>
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
       login: false,
       signup: false,
       userState: "登录",
       isLogin: false,
       loginform: {
          username: "",
          password: ""
        },
       signupform: {
          username: "",
          password: ""
        }
    }
  },
  mounted: function(){

  },
  methods: {
    clickToLogin: function() {
        this.login = true;
    },
    cancelLogin: function() {
        this.login = false;
    },
    clickToLogout: function() {
        var that = this
        this.$axios.get('/api/user/logout')
        .then(function (response) {
           if(response.data.status == 1){
                that.userState = "登录";
                that.isLogin = false;
           }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    clickToSignup: function(){
        this.signup = true;
    },
    cancelSignup: function(){
        this.signup = false;
    },
    onLoginSubmit() {
        var that = this
        this.$axios.get('/api/user/login',{
            params: {
                username: this.loginform.username,
                password: this.loginform.password
            }
        })
        .then(function (response) {
           if(response.data.status == 1){
                that.userState = response.data.msg;
                that.isLogin = true;
           }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    onSignupSubmit() {
        var that = this
        this.$axios.get('/api/user/signup',{
            params: {
                username: this.signupform.username,
                password: this.signupform.password
            }
        })
        .then(function (response) {
           if(response.data.status == 1){
                that.userState = response.data.msg;
                that.isLogin = true;
           }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    testapi() {
        this.$axios.get('/api/activity/add?title=test')
        .then(function (response) {
           console.log(response.data)
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
    .loginform-wrapper,.signupform-wrapper
        position: relative
        top: 100px
        margin: auto auto
        width: 50%
        z-index: 2
        
</style>
