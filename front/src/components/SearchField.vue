<template>

    <div class="col-relative">
        <i v-if="searching" class="spinner"></i>
        <a v-if="hasitem" class="customer-remover" @click="removeitem"><i class="mdi mdi-close-circle-outline"></i></a>
        <FormControl :type="'text'" v-model="modelValue.name" :placeholder="placeholder" :error="errors.name" @input="onNameInput" :disabled="hasitem" :required="false"/>
        <div class="user-suggestions" v-if="suggestions.length>0">                                  
        <!--
            <span class="close-suggestions"><i class="mdi mdi-close-circle-outline"></i></span>
            -->
            <template v-for="(item,index) in suggestions">
            <div class="user-suggestion" @click="fill(index)"> <slot name="row" v-bind="item"><img width="25px" src="@/assets/images/faces-clipart/pic-1.png">{{item.name}}</slot></div>
            </template>

        </div>

    </div>

</template>


<script>

    export default{

        name:"searchField",

        props:{
            url:{
                type:String,
                default:''
            },
            modelValue:{
                type:Object,
                default:{}
            },
            errors:{
                type:Object,
                default:{}
            },
            placeholder:{
                type:String,
                default:'Escribe para buscar'
            }

        },

        data(){

            return {
                searching:false,
                suggestions:[],
                hasitem:false

            }

        },

        methods:{

            fill(index){

                    this.hasitem=true;

                    this.$emit('selectedItem',this.suggestions[index]);

                    this.suggestions=[];

            },

            onNameInput(e){



                console.log(e);
                    if(!this.searching && e.length>=3)
                    {


                        this.searching=true;
                        this.$api.get(this.url.replace('{key}',e)).then(response=>{


                            this.suggestions=response.data;


                        }).catch(error=>{


                        }).finally(()=>{
                        this.searching=false;
                        });

                    }

            },

            removeitem(){

                this.hasitem=false;
                this.$emit('selectedItem',{});

            }

        }


    }

</script>

<style scoped>


.customer-remover{
  position:absolute;
  right:26px;
  top:12px;
  cursor:pointer;
  color:#e18484;

}

.user-suggestions{
  
    background: #fff;
    padding: 10px;
    box-shadow: 0px 4px 19px rgba(50, 50, 50, .2);
    border-radius: 1px;
    position:absolute;
    top:51px;
    left:0;
    width:100%;
  
  }

  .user-suggestion{
    font-size:14px;
    small{

      margin-left:30px

    }
  }

  .spinner{position:absolute;right:25px;top:12px}

.col-relative{position:relative;}


</style>