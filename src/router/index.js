import Vue from 'vue'
import Router from 'vue-router'
import Register from '@/components/Register'
import Login from '@/components/Login'
import Dashboard from '@/components/Dashboard'
import UserListing from '@/components/UserListing'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '',
      name: 'Login',
      component: Login
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/register',
      name: 'Register',
      component: Register
    },
    {
      path: '/Dashboard',
      name: 'Dashboard',
      component: Dashboard
    },
    {
      path: '/user-listing',
      name: 'UserListing',
      component: UserListing
    }
  ],
  mode:'history'
})
