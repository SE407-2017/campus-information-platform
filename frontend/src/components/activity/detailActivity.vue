<template>
  <div class="detailActivity">
    <div class="main-wrapper">
        <div class="title">{{detail.title}}</div>
        <div class="avatar"></div>
        <div class="division"></div>
        <div class="description">{{detail.description}}</div>
        <div class="division"></div>
        <div class="comment-wrapper">
            <p class="title">评论</p>
            <el-input
              type="textarea"
              :rows="2"
              placeholder="请输入内容"
              v-model="textarea">
            </el-input>
            <el-button type="primary" round class="btn" @click="addComment">发布评论</el-button>
        </div>
    </div>
    <div class="intro-wrapper">
        <div class="abstract">
            <div class="time">时间：{{detail.time}}</div>
            <div class="place">地点：{{detail.place}}</div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'app',
  data() {
    return {
        detail: {
            title: "",
            description:"",
            time: "",
            place: ""
        },
        textarea: ''
    }
  },
  mounted: function() {
    var data = this.$route.params.data
    this.detail.title = data.title;
    this.detail.description = data.desc;
    this.detail.place = data.place;
    this.detail.time = data.time;
  },
  method: {
    addComment: function(){
        var that = this;
        this.$axios.get('/api/comment/add?id='+this.$route.params.id + "&comment="+this.textarea)
        .then(function (response) {
            if(response.data.status){
                console.log(that.data.data)
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
        .avatar
            background-image: url("avatar.jpg")
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
            
        
        
</style>
