<template>
<div class="header">
    <div class="header-wrapper">
        <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal"  background-color="#545c64" text-color="#fff" active-text-color="#ffd04b">
          <div class="title-wrapper">
            <el-menu-item index="1" class="title" @click="goHomePage">校园信息平台</el-menu-item>
          </div>
          <!-- <el-menu-item index="2"></el-menu-item> -->
          <div class="menu-wrapper">
            <el-menu-item index="2" @click="goHomePage">活动</el-menu-item>
          </div>
          <div class="search-wrapper">
              <el-input v-model="input" placeholder="请输入内容"></el-input>
          </div>
          <div class="state-wrapper">
              <el-menu-item v-show="isLogin" index="3">
                <el-dropdown @command="handleCommand">
                  <el-menu-item index="4" >{{userState}}</el-menu-item>
                  <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item :command="myInfo">个人中心</el-dropdown-item>
                    <el-dropdown-item :command="myActivity" >我的活动</el-dropdown-item>
                    <el-dropdown-item :command="clickToLogout" >注销</el-dropdown-item>
                  </el-dropdown-menu>
                </el-dropdown>
              </el-menu-item>
              <el-menu-item index="4" @click="clickToLogin" v-show="!isLogin">登录</el-menu-item>
              <el-menu-item index="6" @click="clickToSignup">注册</el-menu-item>
              <el-menu-item index="7" @click="testapi">测试</el-menu-item>
          </div>
        </el-menu>
    </div>
    
   
    
    
    <div class="loginform-wrapper" v-show="login">
        <div class="title">登录</div>
        <el-form ref="form" class="form" :model="loginform" label-width="80px">
            <div unselectable="on" style="z-index:-1;background:#000;filter:alpha(opacity=500);opacity:.4;left:0px;top:0px;position:fixed;height:100%;width:100%;overflow:hidden;"></div>
            <el-form-item label="用户名">
                <el-input v-model="loginform.username"></el-input>
            </el-form-item>
            <el-form-item label="密码">
                <el-input v-model="loginform.password"  type="password"></el-input>
            </el-form-item>
            <div class="newlogin">
                <el-button type="primary" @click="onLoginSubmit">登录</el-button>
                <el-button @click="cancelLogin">取消</el-button>
            </div>
        </el-form>
    </div>
    
    <div class="signupform-wrapper" v-show="signup">
        <div class="title">注册</div>
        <el-form ref="form" class="form" :model="signupform" label-width="80px">
            <el-form-item label="用户名">
                <el-input v-model="signupform.username"></el-input>
            </el-form-item>
            <el-form-item label="密码">
                <el-input v-model="signupform.password"  type="password"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSignupSubmit">注册</el-button>
                <el-button @click="cancelSignup">取消</el-button>
            </el-form-item>
        </el-form>
    </div>

    <div class="message-wrapper">
        <el-button :plain="true" @click="success(action)"></el-button>
        <el-button :plain="true" @click="error(action)"></el-button>
    </div>

</div>
</template>

<script>
const LOGIN = 1;
const SIGNUP = 2;
const LOGOUT = 3;
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
    var that = this
    // render之前先判断一下session中是否有用户已经登录
    this.$axios.get('/api/isLogin')
        .then(function (response) {
          var data = response.data;
          if(data) {
            that.userState = data.username
            that.isLogin = true;
          } else {
            that.isLogin = false;
          }
        })
        .catch(function (error) {
          console.log(error);
        });
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
                that.success(LOGOUT);
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
                that.userState = response.data.username;
                that.isLogin = true;
                that.login = false;
                that.success(LOGIN);
           } else{
                that.error(response.data.msg);
           }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    onSignupSubmit() {
        var that = this
        var form_username = this.signupform.username;
        var form_password = this.signupform.password;
        this.$axios.get('/api/user/signup',{
            params: {
                username: form_username,
                password: form_password
            }
        })
        .then(function (response) {
           if(response.data.status == 1){
                that.success(SIGNUP);
                // 注册成功后自动登录
                that.$axios.get('/api/user/login',{
                    params: {
                        username: form_username,
                        password: form_password
                    }
                })
                .then(function (response) {
                   if(response.data.status == 1){
                        that.userState = form_username;
                        that.isLogin = true;
                   }
                })
                .catch(function (error) {
                  console.log(error);
                });
           } else {
               that.error(response.data.msg)
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
    },
    goHomePage() {
      this.$router.push({path:'/'});
    },
    myInfo() {
      this.$router.push({path:'/user/info'});
    },
    myActivity() {
      this.$router.push({path:'/add/activity'});
    },
    success(action) {
        if(action == 1){
            this.$message({
              message: '登陆成功',
              type: 'success'
            });
        } else if (action == 2) {
            this.$message({
              message: '注册成功',
              type: 'success'
            });
        } else if (action == 3) {
            this.$message({
              message: '注销成功',
              type: 'success'
            });
        }
    },
    error(msg) {
        this.$message.error(msg)
    },
    handleCommand(command) {
        this.$message(command);
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="stylus" rel="stylesheet/stylus">
@import url("//unpkg.com/element-ui@2.0.4/lib/theme-chalk/index.css");
.header
    text-align: center
    position: relative
    .header-wrapper
        margin-top: -10px
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
        padding-left: 40px
        padding-right: 40px
        height: 285px
        background-color:#f3f3f3
        position: absolute
        top: 190px
        left: 500px
        margin: auto auto
        width: 30%
        z-index: 2
        .title
            z-index: 2
            position: relative
            // top: 60px
            text-align: left
            line-height: 100px
            height: 50px
            font-size: 30px
            background-color:#f3f3f3
            .newlogin
                margin-left: 15px
        .form
            z-index: 2
            position: relative
            top: 50px
    .message-wrapper
        display: none
    
    
        
</style>