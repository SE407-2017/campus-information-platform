<template>
 <div class="editor">
    <vue-editor v-model="content" :editorToolbar="customToolbar"></vue-editor>
 </div>
</template>

<script>
import {VueEditor} from 'vue2-editor'
export default {
  name: 'editor',
  components: {
    VueEditor
  },
  data(){
    return {
         content: '<h1>Some initial content</h1>'  
       }
  }
}
</script>

<style lang="stylus" rel="stylesheet/stylus">

</style>
