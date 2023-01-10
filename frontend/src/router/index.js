import Vue from 'vue'
import Router from 'vue-router'
import Appointment from '@/components/Appointment'
import TotalFee from '@/components/TotalFee'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Appointment',
      component: Appointment
    },
    {
      path: '/total_fee',
      name: 'TotalFee',
      component: TotalFee
    }
  ]
})
