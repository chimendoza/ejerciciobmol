<template>

    <formUser v-model="model" v-bind:profiles="profiles">
        <template v-slot:submit>
            <SubmitButton label="Guardar"/>
        </template>
    </formUser>



</template>

<script>

    import formUser from './form.vue';


    export default{

        components:{
            formUser
        },

    data(){

        return {

            model:{},
            profiles:[]
            
        }
    },
        

    methods:{


        onModelData(data){

            
            this.model=data;
            this.profiles=data.profiles;
            

        },
        onModelSaved(data){

            console.log(data);


        }

    },
    mounted(){


        
        this.loadModel();

    }




    }




</script>