<template>
  <div class="activity">
     <div class="activity-wrapper">
        <div class="activity-item">
            <div class="avatar"></div>
            <div class="content">
                <div class="title">运营修炼之道</div>
                <div class="time">时间：2017-11-22 周三</div>
                <div class="place">城市：上海</div>
            </div>   
        </div>
     </div>
  </div>
</template>

<script>
export default {
  name: 'activity',
  data(){
    return {
        activityArr: []
    }
  },
  mounted: function(){
    var that = this
    this.$axios.get('/api/activity/read')
        .then(function (response) {
            that.activityArr = response.data.data
            console.log(that.activityArr)
        })
        .catch(function (error) {
          console.log(error);
        });
  }
 
}
</script>

<style lang="stylus" rel="stylesheet/stylus">
.activity
    margin: 80px 60px 0px 60px
    .activity-wrapper
        display: flex
        flex-wrap: wrap
        .activity-item
            flex: 0 0 25%
            margin-bottom: 30px
            .avatar
                background-image: url("avatar.jpg")
                background-size: 150px 150px
                width: 150px
                height: 150px
                display: inline-block
            .content
                display: inline-block
                vertical-align: top
                font-size: 14px
                color: #999
                .title
                    font-size: 20px
                    color: #333
                    margin-bottom: 15px
                .time
                    margin-bottom: 5px

        
</style>
