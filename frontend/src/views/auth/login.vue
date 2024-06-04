<template>
  <div>
    <h4 style="text-align: center; padding-bottom: 3%;">Login Page</h4>
    <p v-if="error">User or password invalid. Try Again.</p>
    <form @submit.prevent="login" style="margin-left: 35%;">
      <div class="row">
        <div class="six columns">
          <label for="email">Email</label>
          <input v-model="email" class="u-full-width" type="email" name="email" required>
        </div>
      </div>
      <div class="row">
        <div class="six columns">
          <label for="password">Password</label>
          <input v-model="password" class="u-full-width" type="password" name="password" required>
        </div>
      </div>
      <div class="row">
        <div class="three columns">
          <input class="button" type="submit" value="Login">
        </div>
        <div class="three columns">
          <router-link to="/register" class="button">Registration</router-link>
        </div>
      </div>
    </form>
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
        const response = await axios.get('https://meetingscalendar.000webhostapp.com/server/user', {
          headers: {
            'Accept': 'application/json'
          }
        });

        const users = response.data;
        const user = users.find(user => user.email === this.email && user.password === this.password);

        if (user) {
          localStorage.setItem('userId', user.id);
          this.$router.push('/calendario');
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
