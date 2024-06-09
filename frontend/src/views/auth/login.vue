<template>
  <div id="bodyLogin">
    <div id="loginDiv">
    <h4>Login Page</h4>
         <div class="border-bottom"></div>
    <p v-if="error">User or password invalid. Try Again.</p>
    <form id="loginForm" @submit.prevent="login">
      <div class="row">
        <div class="six columns">
          <label for="email">Email</label>
          <input v-model="email" class="u-full-width" type="email" name="email" placeholder="Escribe tu correo" required>
        </div>
      </div>
      <div class="row">
        <div class="six columns">
          <label for="password">Password</label>
          <input v-model="password" class="u-full-width" type="password" placeholder="Escribe tu contraseña" name="password" required>
        </div>
      </div>
      <div class="row" style="padding-top: 5%;">
        <div class="three columns" >
          <input class="button" type="submit" value="Login" style="width: 19%;">
        </div>
        <div class="three columns">
          <router-link to="/register" class="button" style="width: 28%;">Registration</router-link>
        </div>
      </div>
    </form>
  </div>
  </div>

</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      error: false
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.get('https://calendarmeetings.000webhostapp.com/server/user', {
          headers: {
            'Accept': 'application/json'
          }
        });

        const users = response.data;
        const user = users.find(user => user.email === this.email && user.password === this.password);

        if (user) {
          if (user) {
            localStorage.clear(); 
      localStorage.setItem('userId', user.id);
      console.log('User logged in. UserId:', user.id);
      await this.$nextTick();
      this.$emit('loggedIn', user.id);
      this.$router.push('/calendario');
}

        } else {
          this.error = true;
        }
      } catch (error) {
        console.error("Login error: ", error); 
        this.error = true;
      }
    }
  }
};
</script>

<link rel="stylesheet" href="/css/skeleton.css" />
<link rel="stylesheet" href="/css/login.css" />
<link rel="stylesheet" href="/css/home.css" />
<link rel="stylesheet" href="/css/footer.css" />
