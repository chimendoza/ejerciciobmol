<template>
    <button v-bind:class="ctx.issaving || saving?'disabled':''" class="btn btn-gradient-primary btn-icon-text">{{label!=''?label:'Enviar'}} <i v-if="ctx.issaving || saving"  class="spinner"></i></button>
</template>

<script>


export default{

    name:"SubmitButton",
    data(){

        return {
            ctx:{}
        }

    },

    props:{
        saving:{
            type:Boolean,
            default:false
        },
        label:{
            type:String,
            default:''
        },
        context:{
            type:Object,
            default:{}
        }
    },

    mounted(){

        
        if(Object.entries(this.context).length==0){
            this.ctx=this.$parent;
        }else{
            this.ctx=this.context;
        }


    }


}

</script>


<style scoped>

    .spinner{
        position: absolute;
        right: 12px;
        top: 11px;
    }

</style>