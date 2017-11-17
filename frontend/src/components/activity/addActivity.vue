<template>
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
</template>

<script>
export default {
  name: 'app',
  data() {
    return{
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
  }

}
</script>

<style lang="stylus" rel="stylesheet/stylus">

</style>
