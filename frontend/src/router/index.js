import Vue from 'vue'
import Router from 'vue-router'
import ListActivity from '../components/activity/listActivity'
import AddActivity from '../components/activity/addActivity'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'ListActivity',
      component: ListActivity
    },
    {
      path: '/add/activity',
      name: 'AddActivity',
      component: AddActivity
    }
  ]
})
