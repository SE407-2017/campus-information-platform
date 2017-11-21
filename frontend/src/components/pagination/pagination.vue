<template>
<div class="block">
  <el-pagination
    layout="prev, pager, next"
    :total="10*totalPage" @current-change="handleCurrentChange">
  </el-pagination>
</div>
</template>

<script>
import bus from '../../common/bus.js'
export default {
  name: 'pagination',
  props: {
    totalPage: {
        type: Number
    }
  },
  methods: {
    handleCurrentChange: function(currentPage){
        var that = this;
        this.$axios.get('/api/activity/read?page='+currentPage)
        .then(function (response) {
            if(response.data.status){
                bus.$emit('turnPage', response.data.data)
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

</style>
