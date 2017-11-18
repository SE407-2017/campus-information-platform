<template>
  <div class="detailActivity">
    <div class="main-wrapper">
        <div class="title">本科学术系列讲座（八）</div>
        <div class="avatar"></div>
        <div class="description">本科学术系列讲座是我院本科生的必修课程“专业学术报告”的组成部分之一，它是将经济管理领域的理论知识和工具与社会实践特别是经济管理领域的热点问题相结合的学术导向课程。通过本课程的学习，促使学生熟悉经济管理领域的相关问题或关注要点，了解问题和热点背后的知识基础和作用机制，提升学生观察问题、思考问题、提出应对问题的基本学术素养，为未来从事科研和实际经济管理领域相关的工作打下扎实的基础。

讲座嘉宾将结合当前的经济管理热点或学术前沿，邀请学院教师安排系列讲座，每次2小时；讲座将分经济和管理两个专业组织的专场学术讲座。学生参加不少于16次报告或讲座，并每次撰写报告听后感，每篇听后感不低于1000字。</div>
    </div>
    <div class="intro-wrapper">
        <div class="abstract"></div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'app',
  mounted: function() {
    this.$axios.get('/api/activity/read?id='+this.$route.params.id)
        .then(function (response) {
            console.log(response.data)
        })
        .catch(function (error) {
          console.log(error);
        });
  }
}
</script>

<style lang="stylus" rel="stylesheet/stylus">

</style>
