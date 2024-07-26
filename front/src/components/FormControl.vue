<template>


    <span class="form-input" v-if="type=='text'">
        <skeleton :type="'text'" v-if="ctx.isretrieving"></skeleton>
        <input type="text" v-else class="form-control" v-bind:disabled="disabled" v-bind:class="[{'error':error},className]" v-bind:required="required" v-bind:placeholder="placeholder" @input="updateModel" v-bind:value="modelValue"/>
        <span v-if="error!=''" class="error-note">{{ error }}</span>
        
    </span>

    <span class="form-input" v-if="type=='password'">
        <skeleton :type="'text'" v-if="ctx.isretrieving"></skeleton>
        <input type="password" v-else class="form-control" v-bind:disabled="disabled" v-bind:class="[{'error':error},className]" v-bind:required="required" v-bind:placeholder="placeholder" @input="updateModel" v-bind:value="modelValue"/>
        <span v-if="error!=''" class="error-note">{{ error }}</span>
    </span>

    <span class="form-input" v-if="type=='tel'">
        <skeleton :type="'tel'" v-if="ctx.isretrieving"></skeleton>
        <input v-type="'tel'" v-else class="form-control" v-bind:disabled="disabled" v-bind:class="[{'error':error},className]" v-bind:required="required" v-bind:placeholder="placeholder" @input="updateModel" v-bind:value="modelValue"/>
        <span v-if="error!=''" class="error-note">{{ error }}</span>
    </span>


    <span class="form-input" v-if="type=='textarea'">
        <skeleton :type="'textarea'" v-if="ctx.isretrieving"></skeleton>
        <textarea v-bind:rows="rows" v-else class="form-control" v-bind:disabled="disabled" v-bind:class="[{'error':error},className]" v-bind:required="required" v-bind:placeholder="placeholder" @input="updateModel" v-bind:value="modelValue"></textarea>
        <span v-if="error!=''" class="error-note">{{ error }}</span>
    </span>

    <span class="form-input" v-if="type=='select'">
        <skeleton :rows="1" :cols="1" :type="'text'" v-if="ctx.isretrieving"></skeleton>
        <select class="form-control" v-bind:class="[{'error':error},className]" v-bind:disabled="disabled" v-else v-bind:required="required" v-bind:value="modelValue" @change="updateModel">
            <option v-for="item in options" :key="item.id" v-bind:value="item.id">
                {{item[label]}}
            </option>
        </select>
        <span v-if="error!=''" class="error-note">{{ error }}</span>
    </span>

    <span class="form-input" v-if="type=='switch'">
        <skeleton :type="'switch'" v-if="ctx.isretrieving"></skeleton>
        <span v-else class="form-switch">
            <input type="checkbox" class="form-check-input switch-input" v-bind:disabled="disabled" @click="updateModel" :checked="modelValue" value="1" true-value="1" false-value="0"/>
        </span>
    </span>

</template>


<script>

    import Skeleton from '@/components/Skeleton.vue';

    export default{

        name:"FormControl",
        components:{
            Skeleton
        },
        data(){

            return{

                ctx:{}

            }
        },
        props:{

            type:{
                type:String,
                default:'text'
            },
            modelValue:{},
            options:{
                type:Array,
                default:[]
            },
            label:{
                type:String,
                default:'nombre'
            },

            required:{
                type:Boolean,
                default:false,
            },
            placeholder:{
                type:String,
                default:''
            },
            rows:{
                type:Number
            },
            context:{
                type:Object,
                default:{}
                
            },
            error:{
                type:String,
                default:''
            },
            disabled:{

                type:Boolean,
                default:false

            },
            className:{

                type:String,
                default:''

            }
            

                
            
        },

        emits:['input','update:modelValue'],
        methods:{

            updateModel(e){


                let val=e.target.value;
                /*if(parseFloat(val)!=NaN){
                    val=parseFloat(val);
                }*/
                

                if(this.type=='switch'){
                    val=e.target.checked?1:0;
                }


                this.$emit('update:modelValue',val);

                if(this.type=='text'){
                    this.$emit('input',val);
                }


            }
        },

/*
        computed:{


            haserror(){

                return function(){

                    console.log(this.$root.errors);
                
                if(this.$parent.errors[this.error]!=''){
                    console.log(":D");
                    
                    return this.$parent.errors[this.error];
                    
                }else if(this.$root._errors.length>0){
                    console.log(":()");
                    return this.$root._errors[this.error];
                    


                }else{

                    console.log(":/");
                    return '';
                }


                }

            }


        },
*/  
        mounted(){


            
            if(Object.entries(this.context).length==0){

                this.ctx=this.$parent.$parent;
            }else{
                this.ctx=this.context;
            }
            
        }



    }

</script>