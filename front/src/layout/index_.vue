<template>
    <div class="container-scroller">
    
    <NavBar/>
        <div class="container-fluid page-body-wrapper">

            <SideBar/>
            <div class="main-panel">
                <router-view></router-view>
                <FooterPage/>
            </div>
        
        </div>
    </div>
    
    </template>

<script>


import NavBar from './NavBar.vue'
import SideBar from './SideBar.vue'
import FooterPage from './FooterPage.vue'

export default {
    components:{
        NavBar,
        SideBar,
        FooterPage

    },
    
    setup() {
    // ...
  }
}


</script>