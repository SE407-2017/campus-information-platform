<template>
  <div class="detailActivity">
    <div class="main-wrapper">
        <div class="title">{{detail.title}}</div>
        <div class="avatar"></div>
        <div class="division"></div>
        <div class="description">{{detail.description}}</div>
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
        }
    }
  },
  mounted: function() {
    var data = this.$route.params.data
    this.detail.title = data.title;
    this.detail.description = data.desc;
    this.detail.place = data.place;
    this.detail.time = data.time;
    }
}
</script>

<style lang="stylus" rel="stylesheet/stylus">
.detailActivity
    display: flex
    margin: 80px 200px 0 300px
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
            
    .intro-wrapper
        background-color: white
        flex: 0 0 20%
        font-size: 14px
        color: #333
        
        
</style>
