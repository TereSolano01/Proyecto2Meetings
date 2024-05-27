<template>
  <div id="app">
    <navbar /> 
    <router-view /> 
    <FooterComponent /> 
  </div>
</template>

<script>
import navbar from './views/navbar.vue';
import FooterComponent from './views/footer.vue'; 

export default {
  components: {
    navbar, 
    FooterComponent 
  }
}
</script>

