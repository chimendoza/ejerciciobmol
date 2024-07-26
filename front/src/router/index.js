import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import layout from '../layout/index.vue'
import login from '../layout/login.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: layout,
      children:[

        {
          path:'',
          name: 'home',
          component:HomeView

        }


      ]
    },
    {

      path: '/usuarios',
      component: layout,
      children:[

         {
          'path':'',       
          name: 'listarusuarios',
          component: () => import('../views/usuarios/index.vue')
         },

         {
          'path':'crear',       
          name: 'crearUsuario',
          component: () => import('../views/usuarios/create.vue')
         },

         {
          'path':'actualizar/:id',
          name: 'actualizarUsuario',
          component: () => import('../views/usuarios/update.vue')
         },

      ]
    },

    {

      path: '/pagos',
      component: layout,
      children:[

         {
          'path':'',       
          name: 'listarpagos',
          component: () => import('../views/pagos/index.vue')
         },

         {
          'path':'crear',       
          name: 'crearPago',
          component: () => import('../views/pagos/create.vue')
         },

         {
          'path':'actualizar/:id',
          name: 'actualizarPago',
          component: () => import('../views/pagos/update.vue')
         },
         {
          'path':'reporte',
          name: 'reporteUsuario',
          component: () => import('../views/pagos/reporte.vue')
         },




      ]
    },


    {

      path: '/cuentas',
      component: layout,
      children:[

         {
          'path':'',       
          name: 'listarcuentas',
          component: () => import('../views/cuentas/index.vue')
         },

         {
          'path':'crear',       
          name: 'crearcuenta',
          component: () => import('../views/cuentas/create.vue')
         },

         {
          'path':'actualizar/:id',
          name: 'actualizarCuenta',
          component: () => import('../views/cuentas/update.vue')
         },

      ]
    },


    {

      path: '/tipopagos',
      component: layout,
      children:[

         {
          'path':'',       
          name: 'listartipospago',
          component: () => import('../views/tipopagos/index.vue')
         },

         {
          'path':'crear',       
          name: 'crearTipopago',
          component: () => import('../views/tipopagos/create.vue')
         },

         {
          'path':'actualizar/:id',
          name: 'actualizarTipopago',
          component: () => import('../views/tipopagos/update.vue')
         },

      ]
    },



    {

      path: '/login',
      component: login,
      name: 'login'
    }


  ]
})

export default router
