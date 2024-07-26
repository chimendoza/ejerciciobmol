
<template>

        <div class="card">

        <div class="card-body">


        <form class="form-sample" @submit.prevent="saveModel">
                      <p class="card-description"> Datos de la cuenta </p>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Empleado</label>
                            <div class="col-sm-9">
                              <FormControl :type="'select'" v-model="modelValue.usuario_id" :error="$parent._errors.usuario_id" :required="false" :options="usuarios"/>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Banco</label>
                            <div class="col-sm-9">
                              <FormControl :type="'text'" v-model="modelValue.banco" :error="$parent._errors.banco" :required="true"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Clave interbancaria</label>
                            <div class="col-sm-9">
                              <FormControl :type="'text'" v-model="modelValue.clave_interbancaria" :error="$parent._errors.clave_interbancaria" :required="true"/>
                            </div>
                          </div>
                        </div>

                      </div>


                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Número de cuenta</label>
                            <div class="col-sm-9">

                              <FormControl :type="'text'" v-model="modelValue.no_cuenta" :error="$parent._errors.no_cuenta" :required="true"/>

                            </div>
                          </div>
                        </div>
                       <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Tipo de cuenta</label>
                            <div class="col-sm-9">
                              <FormControl :type="'select'" v-model="modelValue.tipo_cuenta" :error="$parent._errors.tipo_cuenta" :options="tiposcuenta"/>

                            </div>
                          </div>
                        </div>
                    </div>





                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Sucursal</label>
                            <div class="col-sm-9">

                              <FormControl :type="'text'" v-model="modelValue.sucursal" :error="$parent._errors.sucursal" :required="true"/>

                            </div>
                          </div>
                        </div>
                       <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Fecha de registro</label>
                            <div class="col-sm-9">
                              <FormControl :type="'text'" v-model="modelValue.fecha_registro" :error="$parent._errors.fecha_registro"/>

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

          usuarios:[],
          tiposcuenta:[{id:1,nombre:'Debito'},{id:2,nombre:'Crédito'}]

        }

      },
      props:{

        modelValue:{
          type:Object,
          default:{}
        }
      },

      mounted(){


        this.$api.get('/usuarios').then(response=>{


          this.usuarios=response.data;


        });


      }




    }


</script>

