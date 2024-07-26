<template>
              
    <table class="table">
    <thead>
        <tr>
            <th><input type="checkbox"></th>

            <slot name="headers"></slot>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>

        <tr v-if="isloading">
        <td colspan="10">
        <skeleton :rows="3" :cols="3"></skeleton>
        </td>
        </tr>


        <tr v-for="(item, index) in items" :key="index">
        
            
            <td><slot name="checkbox" v-bind="{item:item,items:items}"><input type="checkbox"/></slot></td>


            
            <slot name="row" v-bind="item"></slot>

      
            <td>
                <slot name="update" v-bind="item">
                    <router-link class="action-link" :to="autolink('/actualizar/'+item.id)"><i class="mdi mdi-square-edit-outline"></i></router-link>
                </slot>

                <slot name="delete" v-bind="{item:item,items:items}">
                    <a class="action-link" @click="deleteModel(item.id,route)"><i class="mdi mdi-delete-outline"></i></a>
                </slot>

                
            </td>

        
        </tr>
    </tbody>
    </table>


</template>


<script>


    import Skeleton from '@/components/Skeleton.vue';
    

    export default {
         name:"InteracTable",
        components:{Skeleton},
        props:{

            route:{type:String,
                   required:true    
            },
            rows:{
                type:Array,
                default:[]
            }

        },


        methods:{



            loadItems(){


                this.$api.get(this.route).then(response=>{

                    this.isloading=false;
                    this.items=response.data;

                })

                
            },



        },

         data(){

            return {

                isloading:true,
                items:[],

            }

         },

         mounted(){

            this.loadItems();

            
         },
         watch:{

            rows:{
                handler:function(items){

                    this.items=items;

                }
            }

         }

         

   
    }

</script>


<style>


.table-responsive{clear:both !important}

</style>