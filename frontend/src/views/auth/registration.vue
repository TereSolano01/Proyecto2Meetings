<template>
  <div>
    <form @submit.prevent="register" class="container">
      <h4>Registration Page</h4>
      <div class="row"> 
        <div class="six columns">  
          <label for="name">Full name</label>  
          <input v-model="name" class="u-full-width" type="text" name="name">  
        </div>
      </div>
      <div class="row"> 
        <div class="six columns">  
          <label for="email">Email</label>  
          <input v-model="email" class="u-full-width" type="text" name="email">  
        </div>
      </div>
      <div class="row"> 
        <div class="six columns">  
          <label for="password">Password</label>  
          <input v-model="password" class="u-full-width" type="password" name="password">  
        </div>
      </div>
      <input class="button" type="submit" value="Submit">
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      email: '',
      password: ''
    };
  },
  methods: {
    register() {
      // Lógica para enviar los datos de registro al servidor
    }
  }
};
</script>


<link rel="stylesheet" href="/css/skeleton.css" />
<link rel="stylesheet" href="/css/login.css" />
<link rel="stylesheet" href="/css/home.css" />
<link rel="stylesheet" href="/css/footer.css" />
