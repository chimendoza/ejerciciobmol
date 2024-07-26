
<template>
<div class="row">
    <div class="col-12 grid-margin">

      
      <div class="card">
        <div class="card-body">

      <router-link to="/tipopagos/crear" class="btn pull-right btn-gradient-primary btn-icon-text btn-sm">
                            <i class="mdi mdi-plus btn-icon-append"></i> Agregar </router-link>    
      
          <h4 class="card-title page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2"> 
              <i class="mdi mdi-account-star"></i> </span> 
            Listando tipos de pago
          </h4>
      

      
          <div class="table-responsive">



            <InteracTable :route="autolink()">

              <template v-slot:headers>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th></th>
              </template>

              <template v-slot:row="item">
                  <td>{{item.id}}</td>
                  <td>{{ item.nombre }}</td>

              </template>
            
            </InteracTable>




          </div>
        </div>
      </div>
    </div>
  </div>

  </template>


  <script>


    
    import InteracTable from '@/components/InteracTable.vue';

    export default {

        name:"ListUsers",
        components:{
            InteracTable

        },


    }



  </script>