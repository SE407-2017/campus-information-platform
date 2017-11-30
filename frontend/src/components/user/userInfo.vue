<template>
<div class="userInfo">
  <div class="nav-wrapper">
      <el-row class="tac">
        <el-col :span="12">
          <el-menu
            default-active="1"
            class="el-menu-vertical-demo"
            background-color="#545c64"
            text-color="#fff"
            active-text-color="#ffd04b">
            <el-menu-item index="1" @click="myInfo">
                <i class="el-icon-location"></i>
                <span slot="title">我的信息</span>
            </el-menu-item>
            <el-menu-item index="2" @click="myAct">
              <i class="el-icon-menu"></i>
              <span slot="title">我的活动</span>
            </el-menu-item>
          </el-menu>
        </el-col>
      </el-row>
  </div>
  <div class="user-wrapper" v-show="isMyInfo">
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


  <div class="activity-wrapper" v-show="isMyAct">
      <div class="activity-item" v-for="activity in activityArr">
         <div class="avatar" @click="showDetail(activity.id)"></div>
         <div class="content">
            <div class="title" @click="showDetail(activity.id)" target="_blank">{{activity.title}}</div>
            <div class="time">时间：{{activity.time}}</div>
            <div class="place">城市：{{activity.place}}</div>
         </div>   
      </div>
  </div>

</div>
</template>

<script>
export default {
  data(){
    return {
      userInfo: {},
      isMyInfo: true,
      isMyAct: false,
      activityArr: []
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
      myInfo: function(){
        this.isMyInfo = true;
        this.isMyAct = false;
      },
      myAct: function(){
        this.isMyInfo = false;
        this.isMyAct = true;
        var that = this;
        this.$axios.get('/api/activity/read')
        .then(function (response) {
            that.activityArr = response.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
      },
      showDetail: function(activity_id){
        var that = this
        this.$axios.get('/api/activity/read?id='+activity_id)
        .then(function (response) {
            if(response.data.status){
                // 查询报名状态
                that.$axios.get('/api/apply/inquire?actid=' + activity_id)
                .then(function (res) {
                    if(res.data.status)
                        response.data.data.applyStatus = "取消报名";
                    else
                        response.data.data.applyStatus = "立即报名";
                })
                .catch(function (error) {
                  console.log(error);
                });

                console.log(response.data.data)  
                that.$router.push({
                    name: "DetailActivity",
                    params: {
                      id: activity_id,
                      data: response.data.data                    
                  }
             });
            }
        })
        .catch(function (error) {
          console.log(error);
        });
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
    .activity-wrapper
        flex-wrap: wrap
        margin-left: 250px
        margin-top: -140px
        .activity-item
            margin-bottom: 30px
            display: inline-block
            .avatar
                background-image: url("avatar.jpg")
                background-size: 60px 60px
                width: 60px
                height: 60px
                display: inline-block
                cursor: pointer
            .content
                display: inline-block
                // position: relative
                vertical-align: top
                margin-left: 10px
                font-size: 10px
                color: #999
                .title
                    font-size: 12px
                    width: 200px
                    color: #333
                    margin-bottom: 5px
                    cursor: pointer
                .time
                    margin-bottom: 5px
            
        
</style>