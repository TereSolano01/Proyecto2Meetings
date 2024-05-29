<template>
  <div>
    <form @submit.prevent="register" class="container">
      <h4>Registration Page</h4>
      <div class="row"> 
        <div class="six columns">  
          <label for="name">Full name</label>  
          <input v-model="name" class="u-full-width" type="text" name="name" required>  
        </div>
      </div>
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
      <input class="button" type="submit" value="Submit">
      <p v-if="error" class="error">{{ error }}</p>
      <p v-if="success" class="success">{{ success }}</p>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      error: '',
      success: ''
    };
  },
  methods: {
    async register() {
      this.error = '';
      this.success = '';
      try {
        const response = await axios.post('https://meetingscalendar.000webhostapp.com/server/user', {
          name: this.name,
          email: this.email,
          password: this.password
        });

        if (response.data && response.data.message) {
          this.success = response.data.message;
          this.name = '';
          this.email = '';
          this.password = '';
        } else {
          window.location.href = '/calendario';
        }
      } catch (error) {
        if (error.response && error.response.data && error.response.data.error) {
          this.error = error.response.data.error;
        } else {
          this.error = 'Error communicating with the server';
        }
      }
    }
  }
};
</script>

<style>
.error {
  color: red;
}
.success {
  color: green;
}
</style>

<link rel="stylesheet" href="/css/skeleton.css" />
<link rel="stylesheet" href="/css/login.css" />
<link rel="stylesheet" href="/css/home.css" />
<link rel="stylesheet" href="/css/footer.css" />
