
<template>
<div class="row">
    <div class="col-12 grid-margin">

      
      <div class="card">
        <div class="card-body">

      
          <h4 class="card-title page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2"> 
              <i class="mdi mdi-account-star"></i> </span> 
            Listando usuarios
          </h4>
      

      
          <div class="table-responsive">



            <InteracTable :route="'/pagos?expand=usuario,cuenta,tipopago'">

              <template v-slot:headers>
                  <th>ID</th>
                  <th>Clave de empleado</th>
                  <th>Nombre</th>
                  <th>Apellido paterno</th>
                  <th>Apellido materno</th>
                  <th>RFC</th>
                  <th>Clave interbancaria</th>
                  <th>Número de cuenta</th>
                  <th>Tipo de pago del empleado</th>
                  <th>Banco</th>
              </template>

              <template v-slot:row="item">
                  <td>{{item.id}}</td>
                  <td>{{item.usuario.clave_empleado}}</td>
                  <td><img src="@/assets/images/faces-clipart/pic-1.png"/> {{ item.usuario.nombre }}  </td>
                  <td>{{ item.usuario.apellido_paterno }}</td>
                  <td>{{ item.usuario.apellido_materno }}</td>
                  <td>{{ item.usuario.rfc }}</td>
                  <td>{{ item.cuenta.clave_interbancaria}}</td>
                  <td>{{ item.cuenta.no_cuenta}}</td>
                  <td>{{ item.tipopago.nombre}}</td>
                  <td>{{ item.cuenta.banco}}</td>

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