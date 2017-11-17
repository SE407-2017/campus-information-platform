<template>
  <div class="activity">
     <div class="activity-wrapper">
        <div class="activity-item" v-for="activity in activityArr">
            <div class="avatar"></div>
            <div class="content">
                <div class="title">{{activity.title}}</div>
                <div class="time">时间：{{activity.time}}</div>
                <div class="place">城市：{{activity.place}}</div>
            </div>   
        </div>
     </div>
     <el-button size="small" round class="submitActivity">提交活动</el-button>
     <div class="addActivity-wrapper" v-show="addActivity">
        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
             <el-form-item label="活动名称" prop="name">
                <el-input v-model="ruleForm.name"></el-input>
             </el-form-item>
             <el-form-item label="活动地点" prop="region">
                <el-select v-model="ruleForm.region" placeholder="请选择活动地点">
                  <el-option label="上海" value="shanghai"></el-option>
                  <el-option label="北京" value="beijing"></el-option>
                  <el-option label="南京" value="nanjing"></el-option>
                  <el-option label="浙江" value="zhejiang"></el-option>
                </el-select>
             </el-form-item>
             <el-form-item label="活动时间" required>
                <el-col :span="11">
                  <el-form-item prop="date1">
                    <el-date-picker type="date" placeholder="选择日期" v-model="ruleForm.date1" style="width: 100%;"></el-date-picker>
                  </el-form-item>
                </el-col>
                <el-col class="line" :span="2">-</el-col>
                <el-col :span="11">
                  <el-form-item prop="date2">
                    <el-time-picker type="fixed-time" placeholder="选择时间" v-model="ruleForm.date2" style="width: 100%;"></el-time-picker>
                  </el-form-item>
                </el-col>
             </el-form-item>
             <el-form-item label="活动描述" prop="desc">
                <el-input type="textarea" v-model="ruleForm.desc"></el-input>
             </el-form-item>
             <el-form-item>
                <el-button type="primary" @click="submitForm('ruleForm')">添加活动</el-button>
                <el-button @click="resetForm('ruleForm')">取消</el-button>
             </el-form-item>
        </el-form>
     </div>
  </div>
</template>

<script>
export default {
  name: 'activity',
  data(){
    return {
        activityArr: [],
        addActivity: true,
        ruleForm: {
          name: '',
          region: '',
          date1: '',
          date2: '',
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
  mounted: function(){
    var that = this
    this.$axios.get('/api/activity/read')
        .then(function (response) {
            if(response.data.status){
                that.activityArr = response.data.data
                console.log(that.activityArr)
            }
        })
        .catch(function (error) {
          console.log(error);
        });
  },
  methods: {
    submitActivity: function(){
        this.$axios.get('/api/activity/add')
            .then(function (response) {
                if(response.data.status){

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
                margin-left: 10px
                font-size: 14px
                color: #999
                .title
                    font-size: 20px
                    width: 200px
                    color: #333
                    margin-bottom: 15px
                .time
                    margin-bottom: 5px

        
</style>
