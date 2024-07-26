
<template>

        <div class="card">

        <div class="card-body">


        <form class="form-sample" @submit.prevent="saveModel">
                      <p class="card-description"> Datos del usuario </p>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Nombre</label>
                            <div class="col-sm-9">
                              <FormControl :type="'text'" v-model="modelValue.nombre" :error="$parent._errors.nombre" :required="false"/>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Apellido paterno</label>
                            <div class="col-sm-9">
                              <FormControl :type="'text'" v-model="modelValue.apellido_paterno" :error="$parent._errors.apellido_paterno" :required="true"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Apellido materno</label>
                            <div class="col-sm-9">
                              <FormControl :type="'text'" v-model="modelValue.apellido_materno" :error="$parent._errors.apellido_materno" :required="true"/>
                            </div>
                          </div>
                        </div>

                      </div>


                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Clave de empleado</label>
                            <div class="col-sm-9">

                              <FormControl :type="'text'" v-model="modelValue.clave_empleado" :error="$parent._errors.clave_empleado" :required="true"/>

                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">CURP</label>
                            <div class="col-sm-9">

                              <FormControl :type="'text'" v-model="modelValue.curp" :error="$parent._errors.curp" :required="true"/>

                            </div>
                          </div>
                        </div>
                       <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">RFC</label>
                            <div class="col-sm-9">
                              <FormControl :type="'text'" v-model="modelValue.rfc" :error="$parent._errors.rfc"/>

                            </div>
                          </div>
                        </div>
                    </div>





                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Sueldo mensual</label>
                            <div class="col-sm-9">

                              <FormControl :type="'text'" v-model="modelValue.sueldo_mensual" :error="$parent._errors.sueldo_mensual" :required="true"/>

                            </div>
                          </div>
                        </div>
                       <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Fecha de ingreso</label>
                            <div class="col-sm-9">
                              <FormControl :type="'text'" v-model="modelValue.fecha_ingreso" :error="$parent._errors.fecha_ingreso"/>

                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-form-label">Fecha de baja</label>
                            <div class="col-sm-9">
                              <FormControl :type="'text'" v-model="modelValue.fecha_baja" :error="$parent._errors.fecha_baja"/>

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

