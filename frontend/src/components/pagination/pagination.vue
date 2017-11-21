<template>
<div class="block">
  <el-pagination
    layout="prev, pager, next"
    :total="10*totalPage" @current-change="handleCurrentChange">
  </el-pagination>
</div>
</template>

<script>
export default {
  name: 'pagination',
  props: {
    totalPage: {
        type: Number
    }
  },
  methods: {
    handleCurrentChange: function(currentPage){
        console.log(currentPage)
    }
  }
}
</script>

<style lang="stylus" rel="stylesheet/stylus">

</style>
