
<template>

        <div class="card">

        <div class="card-body">


        <form class="form-sample" @submit.prevent="saveModel">
                      <p class="card-description"> Datos del pago </p>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Cuenta</label>
                            <div class="col-sm-9">
                              <FormControl :type="'select'" :label="'no_cuenta'" :options="cuentas" v-model="modelValue.cuenta_id" :error="$parent._errors.cuenta_id" :required="false"/>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Usuario</label>
                            <div class="col-sm-9">
                             {{ nombreempleado }}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Tipo de pago</label>
                            <div class="col-sm-9">
                              <FormControl :type="'select'" v-model="modelValue.tipopago_id" :error="$parent._errors.tipopago_id" :required="true" :options="tipopagos"/>
                            </div>
                          </div>
                        </div>

                      </div>


                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Cantidad</label>
                            <div class="col-sm-9">

                              <FormControl :type="'text'" v-model="modelValue.cantidad" :error="$parent._errors.cantidad" :required="true"/>

                            </div>
                          </div>
                        </div>
                       <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Fecha de pago</label>
                            <div class="col-sm-9">
                              <FormControl :type="'text'" v-model="modelValue.fecha_pago" :error="$parent._errors.fecha_pago"/>

                            </div>
                          </div>
                        </div>
                    </div>




                      <div class="form-group">
                        <label>Activo <FormControl :type="'switch'" v-model="modelValue.active"/></label>
                      </div> 
                              


                      <div class="form-actions">
                        <slot name="cancel">
                          <router-link :to="autolink()" class="btn btn-danger btn-icon-text">Cancelar</router-link>
                        </slot>
                        &nbsp;
                        <slot name="submit">
                          <SubmitButton/>
                        </slot>
                      </div>

                    </form>

                </div>

            </div>

        </template>

<script>

    


    export default{


      name:"clientForm",

      data(){

        return {

          cuentas:[],
          usuarios:[],
          tipopagos:[],
          nombreempleado:'Selecciona la cuenta'

        }

      },
      props:{

        modelValue:{
          type:Object,
          default:{}
        }
      },

      methods:{
        
        updateEmployeName(id){

          let c=this.cuentas.find(e=>e.id==id);

          this.nombreempleado=this.concatEmployeName(c.usuario);

            
        },
        concatEmployeName(c){

            return c.nombre+' '+c.apellido_paterno+' '+c.apellido_materno;

        }
        
      },

      
      mounted(){

        this.$api.get('/pagos/obtenercatalogos').then(response=>{


          this.cuentas=response.data.cuentas;
          this.usuarios=response.data.usuarios;
          this.tipopagos=response.data.tipopagos;


        });

      },
      watch:{

          'modelValue.cuenta_id':{
            handler(v){
              this.updateEmployeName(v);
            },
            deep:true

          }

      }




    }


</script>

