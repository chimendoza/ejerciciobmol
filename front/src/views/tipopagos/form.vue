
<template>

        <div class="card">

        <div class="card-body">


        <form class="form-sample" @submit.prevent="saveModel">
                      <p class="card-description"> Datos del tipo de pago </p>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Nombre del tipo de pago</label>
                            <div class="col-sm-9">
                              <FormControl :type="'text'" v-model="modelValue.nombre" :error="$parent._errors.nombre" :required="false"/>
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
      props:{

        modelValue:{
          type:Object,
          default:{}
        }
      },




    }


</script>

