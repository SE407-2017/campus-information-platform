<template>
  <div class="activity">
      <div class="slider" v-show="activityArr!=[]">
            <h2 class="title">热门活动</h2>
            <el-carousel height="200px" type="card">
              <el-carousel-item v-for="(activity,index) in activityArr"  v-if="index<4">
                <div class="poster" @click="showDetail(activity.id)" :style="{ backgroundImage: 'url(' + activity.poster+ ')' }"></div>
              </el-carousel-item>
            </el-carousel>
      </div>
     <div class="activity-wrapper">
        <div class="activity-item" v-for="activity in activityArr">
            <div class="poster" @click="showDetail(activity.id)" :style="{ backgroundImage: 'url(' + activity.poster+ ')' }"></div>
            <div class="content">
                <div class="title" @click="showDetail(activity.id)" target="_blank">{{activity.title}}</div>
                <div class="time">时间：{{activity.time}}</div>
                <div class="place">城市：{{activity.place}}</div>
            </div>   
        </div>
     </div>
     <div class="addActivity">
        <router-link to="/add/activity">提交活动</router-link>
     </div>
     <div class="pagination-wrapper">
        <Pagination :totalPage="totalPage"></Pagination>
     </div>
  </div>
</template>

<script>
import Pagination from "../pagination/pagination";
import bus from '../../common/bus.js'
export default {
  name: 'activity',
  data(){
    return {
        activityArr: [],
        totalPage: 0
    }
  },
  components: {
    Pagination
  },
  mounted: function(){
    var that = this
    this.$axios.get('/api/activity/read')
        .then(function (response) {
            if(response.data.status){
                console.log(response.data.data)
                that.totalPage = response.data.page
                that.activityArr = response.data.data
            }
        })
        .catch(function (error) {
          console.log(error);
        });
  },
  created: function(){ 
        var that = this
        bus.$on('turnPage', function (msg) {
          that.activityArr = msg
        })
  },
  methods: {
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
        // this.$route.push({
        //     name: "DetailActivity",
        //     params:{id: activity_id}
        // });
        // this.$router.push({path:'/activity/'+activity_id});
    }
  }
 
}
</script>

<style lang="stylus" rel="stylesheet/stylus">
@import url("//unpkg.com/element-ui@2.0.7/lib/theme-chalk/index.css")
.activity
    margin: 80px 60px 0px 60px
    position: relative
    .slider
      display: relative
      width: 700px
      margin: 50px auto 50px auto
      .title
          font-size: 24px
          font-weight: 500
      .el-carousel__item
          z-index: 0
          color: red
          opacity: 0.8
          line-height: 150px
          margin: 0
          .poster
              background-size: 350px 200px
              width: 350px
              height: 200px
              display: inline-block
              cursor: pointer
        .el-carousel__item:nth-child(2n) 
           background-color: #99a9bf
        .el-carousel__item:nth-child(2n+1) 
           background-color: #d3dce6
    .activity-wrapper
        display: flex
        flex-wrap: wrap
        .activity-item
            flex: 0 0 25%
            margin-bottom: 30px
            .poster
                background-size: 150px 150px
                width: 150px
                height: 150px
                display: inline-block
                cursor: pointer
            .content
                display: inline-block
                // position: relative
                vertical-align: top
                margin-left: 10px
                font-size: 14px
                color: #999
                .title
                    font-size: 20px
                    width: 200px
                    color: #333
                    margin-bottom: 15px
                    cursor: pointer
                .time
                    margin-bottom: 5px
          
    .addActivity
        position: absolute
        top: -60px
        right: 10px
        a
            height: 30px
            line-height: 30px
            padding: 0 10px
            background: #fff
            border: 1px #ccc solid
            border-radius: 6px
            color: #333
            /*color: #fff;*/
            display: inline-block
            text-decoration: none
            font-size: 12px
            outline: none
    .pagination-wrapper
        text-align: center
        margin-top: 50px
        
</style>
