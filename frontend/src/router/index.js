import Vue from 'vue'
import Router from 'vue-router'
import ListActivity from '../components/activity/listActivity'
import AddActivity from '../components/activity/addActivity'
import DetailActivity from '../components/activity/detailActivity'

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
    },
    {
      path: '/activity/:id',
      name: 'DetailActivity',
      component: DetailActivity
    }
  ]
})
