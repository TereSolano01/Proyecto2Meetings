<template>
    <div>
      <h1>¡Crea tus Reuniones Presenciales!</h1>
      <p>Organiza tus encuentros cara a cara de manera fácil y efectiva.</p>
      <button v-if="loggedIn" @click="createMeeting" class="btn">Crear Reunión</button>
      <button v-else @click="redirectToLogin" class="btn" style="float: right">Crear Reunión</button>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        loggedIn: false // Aquí debes implementar la lógica para determinar si el usuario está autenticado
      };
    },
    methods: {
      createMeeting() {
        // Lógica para crear la reunión
        this.$router.push('/calendario/create'); // Ajusta esta ruta según tu configuración
      },
      redirectToLogin() {
        // Redirige al usuario a la página de inicio de sesión
        this.$router.push('/login'); // Ajusta esta ruta según tu configuración
      }
    }
  };
  </script>
  
  <style>
  /* Estilos CSS aquí */
  </style>
  
  <!-- Enlaces CSS -->
  <link rel="stylesheet" href="/css/normalize.css" />
  <link rel="stylesheet" href="/css/skeleton.css" />
  <link rel="stylesheet" href="/css/home.css" />
  <link rel="stylesheet" href="/css/footer.css" />
  