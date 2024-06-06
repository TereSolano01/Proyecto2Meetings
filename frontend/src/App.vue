<template>
      <navbar />
  <div id="app">
    <router-view :userId="userId" />
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
  },
  data() {
    return {
      userId: parseInt(localStorage.getItem('userId'))
    };
  }
};
</script>
