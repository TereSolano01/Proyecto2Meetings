<template>
    <div id="home">
      <h1>¡Crea tus Reuniones Presenciales!</h1>
      <p>Organiza tus encuentros cara a cara de manera fácil y efectiva.</p>
      <button v-if="loggedIn" @click="createMeeting" class="btn">Crear Reunión</button>
      <button v-else @click="redirectToLogin" class="btn">Crear Reunión</button>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        loggedIn: false 
      };
    },
    methods: {
      createMeeting() {

        this.$router.push('/calendario/create'); 
      },
      redirectToLogin() {
        this.$router.push('/login'); 
      }
    }
  };
  </script>
  
  <link rel="stylesheet" href="/css/normalize.css" />
  <link rel="stylesheet" href="/css/skeleton.css" />
  <link rel="stylesheet" href="/css/home.css" />
  <link rel="stylesheet" href="/css/footer.css" />
  