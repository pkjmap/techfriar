import Vue from 'vue'
import Router from 'vue-router'
import Appointment from '@/components/Appointment'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Appointment',
      component: Appointment
    }
  ]
})
