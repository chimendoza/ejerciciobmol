<template>

        

<div id="main">

  <router-view></router-view>

  <Notivue v-slot="item">
    <Notification :item="item"/>
  </Notivue>

</div>



  
</template>


<style>

  #main{position:relative;z-index:0}

</style>

<script>

import { Notification,Notivue } from 'notivue'



export default{


  components:{

    Notification,Notivue
  },

  beforeMount() {


    if(localStorage.getItem('access_token')==""){

      this.$router.push("/login")
    }else{
      

    }
},



}


</script>