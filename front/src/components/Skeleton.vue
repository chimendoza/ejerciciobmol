<template>
  <div v-if="type=='table'" class="skeleton-table">
    <div class="skeleton-row" v-for="n in rows" :key="n">
      <div class="skeleton-cell reflect" v-for="m in cols" :key="m"></div>
    </div>
  </div>

  <div v-if="type=='switch'" class="skeleton-switch reflect"></div>

  <div v-if="type=='text'" class="skeleton-text reflect"></div>

  <div v-if="type=='tel'" class="skeleton-tel reflect"></div>

  <div v-if="type=='textarea'" class="skeleton-textarea reflect"></div>

</template>

<script>
export default {
  name: 'Skeleton',

  data(){

    return {

      istable:false


    }

  },  
  props:{

    type:{
      type:String,
      default:"table"
    },  
    cols:{
      type:Number,
      default:5
    },
    rows:{
      type:Number,
      default:5
    }
  },


  


 };
</script>

<style scoped>
.skeleton-table {
  width: 100%;
  border-collapse: collapse;
}

.skeleton-switch{

    width: 3em;
    height: 1.5em;
    border-radius: 10px;
    padding:0 !important;
    
    margin-top:-2px !important;
    display: inline-block;
    position: relative;    
    margin-left: 37px;
    float:right;

}

.skeleton-row {
  display: flex;
}

.skeleton-cell {
  flex: 1;
  height: 24px;
  border-radius:4px;
  margin: 4px;

}

.skeleton-text,.skeleton-tel{
  height:46px;
  border-radius: 4px;
}

.skeleton-textarea{

  height:58px  

}


.reflect{
  background: linear-gradient(90deg, #fafafa 25%, #f0f0f0 50%, #fafafa 75%);
  background-size: 200% 100%;
  animation: skeleton-loading 1.5s infinite;
}

@keyframes skeleton-loading {
  0% {
    background-position: 200% 0;
  }
  100% {
    background-position: -200% 0;
  }
}
</style>
