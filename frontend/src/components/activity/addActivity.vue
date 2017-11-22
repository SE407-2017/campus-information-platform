<template>
<div class="addActivity">
    <div class="addActivity-wrapper" v-show="addActivity">
        <el-form :model="activityForm" :rules="rules" ref="activityForm" label-width="100px" class="demo-activityForm">
             <el-form-item label="活动名称" prop="name">
                <el-input v-model="activityForm.name"></el-input>
             </el-form-item>
             <el-form-item label="活动地点" prop="region">
                <el-select v-model="activityForm.region" placeholder="请选择活动地点">
                  <el-option label="上海" value="上海"></el-option>
                  <el-option label="北京" value="北京"></el-option>
                  <el-option label="南京" value="南京"></el-option>
                  <el-option label="浙江" value="浙江"></el-option>
                </el-select>
             </el-form-item>
             <el-form-item label="活动时间" required>
                <el-col :span="11">
                  <el-form-item prop="date">
                    <el-date-picker type="date" placeholder="选择日期" v-model="activityForm.date" style="width: 100%;"></el-date-picker>
                  </el-form-item>
                </el-col>
             </el-form-item>
             <el-form-item label="活动描述" prop="desc">
                <el-input type="textarea" v-model="activityForm.desc"></el-input>
             </el-form-item>
             <el-form-item>
                <el-button type="primary" @click="submitForm(activityForm)">添加活动</el-button>
                <el-button @click="resetForm()">取消</el-button>
             </el-form-item>
        </el-form>
     </div>
    <div class="message-wrapper">
        <el-button :plain="true" @click="success()"></el-button>
        <el-button :plain="true" @click="error(msg)"></el-button>
    </div>
</div>
</template>

<script>
export default {
  name: 'app',
  data() {
    return{
        addActivity: true,
        activityForm: {
          name: '',
          region: '',
          date: '',
          desc: ''
        },
        rules: {
          name: [
            { required: true, message: '请输入活动名称', trigger: 'blur' },
            { min: 3, max: 20, message: '长度在 3 到 20 个字符', trigger: 'blur' }
          ],
          region: [
            { required: true, message: '请选择活动区域', trigger: 'change' }
          ],
          date1: [
            { type: 'date', required: true, message: '请选择日期', trigger: 'change' }
          ],
          date2: [
            { type: 'date', required: true, message: '请选择时间', trigger: 'change' }
          ],
          desc: [
            { required: true, message: '请填写活动描述', trigger: 'blur' }
          ]
        }
      }
  },
  methods: {
      submitForm: function(activityForm){
          // activityForm.date为Date对象类型
          var year = activityForm.date.getFullYear()
          var month = activityForm.date.getMonth()+1
          var day = activityForm.date.getDate()
          var that = this;
          this.$axios.get('/api/activity/add',{
            params: {
              title: activityForm.name,
              desc: activityForm.desc,
              time: year+"-"+month+"-"+day,
              place: activityForm.region
            }
          })
          .then(function (response) {
              console.log(response.data)
              if(response.data.status){
                  that.success();
                  // 前端路由跳转
                  that.$router.push({path:'/'})
              } else{
                  that.error(response.data.msg)
                  that.$router.push({path:'/'});
              }
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      resetForm: function(){
          this.$router.push({path:'/'})
      },
      success() {
            this.$message({
              message: '添加活功',
              type: 'success'
            });
      },
      error(msg) {
          this.$message.error(msg)
      }
  }
}
</script>

<style lang="stylus" rel="stylesheet/stylus">
.addActivity
  .addActivity-wrapper
      width: 600px
      margin: 80px auto 0 auto
  .message-wrapper
      display: none
</style>
