<template>

    <formUser v-model="model">
        <template v-slot:submit>
            <SubmitButton label="Crear"/>
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
            
        }

    },

    mounted(){

    }


}

</script>