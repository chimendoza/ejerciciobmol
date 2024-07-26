
<template>
<div class="row">
    <div class="col-12 grid-margin">

      
      <div class="card">
        <div class="card-body">

      <router-link to="/pagos/crear" class="btn pull-right btn-gradient-primary btn-icon-text btn-sm">
                            <i class="mdi mdi-plus btn-icon-append"></i> Agregar </router-link>    
      
          <h4 class="card-title page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2"> 
              <i class="mdi mdi-account-star"></i> </span> 
            Listando pagos
          </h4>
      

      
          <div class="table-responsive">



            <InteracTable :route="'/pagos?expand=cuenta,usuario,tipopago'">

              <template v-slot:headers>
                  <th>ID</th>
                  <th>Usuario</th>
                  <th>Cuenta</th>
                  <th>Tipo de pago</th>
                  <th>Fecha del pago</th>
              </template>

              <template v-slot:row="item">
                  <td>{{item.id}}</td>
                  <td><img src="@/assets/images/faces-clipart/pic-1.png"/> {{ item.usuario.nombre }} {{ item.usuario.apellido_paterno }} {{ item.usuario.apellido_materno }}</td>
                  <td>{{ item.cuenta.no_cuenta }}</td>
                  <td>{{ item.tipopago.nombre }}</td>
                  <td>{{ item.fecha_pago }}</td>

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