<template>
  <div class="detailActivity">
    <div class="main-wrapper">
        <div class="title">{{detail.title}}</div>
        <div class="poster" :style="{ backgroundImage: 'url(' + detail.poster+ ')'}"></div>
        <div class="division"></div>
        <div class="description">{{detail.description}}</div>
        <div class="division"></div>
        <div class="comment-wrapper">
            <p class="title">评论</p>
            <div class="comment" v-for="comment in commentArr">
                <div class="poster"></div>
                <div class="content">
                    <div class="username">美玉</div>
                    <div class="text">{{comment.comment}}</div>
                </div>
                <div class="time">5天前</div>
            </div>
            <div class="commentBox">
                <el-input
                  type="textarea"
                  :rows="2"
                  placeholder="请输入评论"
                  v-model="comment">
                </el-input>
                <el-button type="primary" round class="btn" @click="addComment">发布评论</el-button>
            </div>
        </div>
    </div>
    <div class="intro-wrapper">
        <div class="abstract">
            <div class="time">时间：{{detail.time}}</div>
            <div class="place">地点：{{detail.place}}</div>
            <el-button size="small" round class="applyActivty" @click="applyActivty" :class="{applied:isApplied}">{{applyStatus}}</el-button>
        </div>
    </div>

    <div class="message-wrapper">
        <el-button :plain="true" @click="success(action)"></el-button>
        <el-button :plain="true" @click="error(action)"></el-button>
    </div>
  </div>
</template>

<script>
const COMMENT = 1;
const APPLY = 2;
const CANCEL_APPLY = 3;
export default {
  name: 'app',
  data() {
    return {
        detail: {
            title: "",
            description:"",
            time: "",
            place: "",
            poster: ""
        },
        comment: '',
        commentArr: [],
        applyStatus: "",
        isApplied: false
    }
  },
  beforeMount: function() {
    var data = this.$route.params.data;
    this.detail.title = data.title;
    this.detail.description = data.desc;
    this.detail.place = data.place;
    this.detail.time = data.time;
    this.detail.poster = data.poster;
    var that = this
    // 不知道为什么直接取data.applyStatus取不到，暂时通过延时来解决
    setTimeout(function() {
        that.applyStatus = data.applyStatus;
        console.log(data.applyStatus)
        if(that.applyStatus == "取消报名")
            that.isApplied = true;
    }, 200)

  },
  created: function(){
    var that = this;
    var actid = this.$route.params.id;
    // 显示评论
    this.$axios.get('/api/comment/read?actid=' + actid)
    .then(function (response) {
        if(response.data.status){
            that.commentArr = response.data.data;
        }
    })
    .catch(function (error) {
      console.log(error);
    });

  },
  methods: {
    addComment: function(){
        var that = this;
        this.$axios.get('/api/comment/add?actid='+this.$route.params.id + "&comment="+this.comment)
        .then(function (response) {
            if(response.data.status){
                that.success(COMMENT);
                // 将新增的评论暂时加入commentArr数组，没想到更好的方法- -
                that.commentArr.push({comment:that.comment});
                that.comment = "";
            }
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    applyActivty: function(){
        var that = this;
        if(this.applyStatus == "立即报名"){
            this.$axios.get('/api/apply/add?actid='+this.$route.params.id)
            .then(function (response) {
                if(response.data.status){
                    that.success(APPLY);
                    that.applyStatus = "取消报名";
                    that.isApplied = true;

                } else {
                    console.log(response.data.msg)
                }
            })
            .catch(function (error) {
              console.log(error);
            });
        } else{
            this.$axios.get('/api/apply/cancel?actid='+this.$route.params.id)
            .then(function (response) {
                if(response.data.status){
                    that.success(CANCEL_APPLY)
                    that.applyStatus = "立即报名";
                    that.isApplied = false;
                }
            })
            .catch(function (error) {
              console.log(error);
            });
        }
    },
    success(action) {
        if(action == 1){
            this.$message({
              message: '评论成功',
              type: 'success'
            });
        } else if (action == 2) {
            this.$message({
              message: '报名成功',
              type: 'success'
            });
        } else if (action == 3) {
            this.$message({
              message: '取消报名成功',
              type: 'success'
            });
        }
    },
    error(msg) {
        this.$message.error(msg)
    }
  }
}
</script>

<style lang="stylus" rel="stylesheet/stylus">
.detailActivity
    display: flex
    margin: 80px 200px 0 300px
    position: relative
    font-family: lato-regular, 'Helvetica Neue', Helvetica, Arial, 'Hiragino Sans GB', 'Microsoft YaHei', sans-serif
    .main-wrapper
        background-color: white
        margin-right: 50px
        flex: 0 0 50%
        .title
            margin-top: 50px
            font-size: 20px
            text-align: center
        .poster
            background-size: 150px 150px
            width: 150px
            height: 150px
            margin: 30px auto 0 auto
        .division
            border: 1px rgba(213,213,213,0.6) solid
            margin-top: 20px
        .description
            margin-top: 30px
            font-size: 14px
            color: #333
            padding: 0 80px 0 80px
        .comment-wrapper
            margin: 50px 10px
            .title
                font-size: 16px
                text-align: left
                margin-left: 5px
            .comment
                margin-top: 20px
                .poster
                    display: inline-block
                    background-image: url("avatar.jpg")
                    background-size: 50px 50px
                    width: 50px
                    height: 50px
                .content
                    display: inline-block
                    vertical-align: top
                    margin-left: 10px
                    color: #7d7d7d
                    .text
                        margin-top: 5px
                .time
                    display: inline-block
                    color: #7d7d7d
                    float: right
            .commentBox  
                margin-top: 50px 
                .btn
                    border-radius: 20px
                    padding: 10px 16px
                    margin-top: 10px
                    margin-left: 480px
            
    .intro-wrapper
        background-color: white
        flex: 0 0 20%
        font-size: 14px
        color: #333
        .abstract
            text-align: center
            margin-top: 30px
            .applyActivty
                background-color: #009a61
                color: #fff
                margin-top: 10px
            .applied
                background-color: red
    .message-wrapper
        display: none
        
        
</style>
