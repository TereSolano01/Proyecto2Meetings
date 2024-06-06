<template>
  <div id="registrationDiv">
    <form @submit.prevent="register" class="container" style="width: 31%;" id="formRegis">
      <h4 style="padding-bottom: 10%;">Registration Page</h4>
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
      <input class="button" type="submit" value="Submit" style="width: 20%;">
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
#registrationDiv{
  background-image: url('../css/pexels-leeloothefirst-5386754.jpg');
    background-color: rgba(255, 255, 255, 0.2);
    background-size: cover;
    width: 100%;
    height: 100%;
}

#formRegis{
    text-align: center;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 30%;
    height: 74%;
    background-color: #ffffffd6;
    padding: 23px;
    border-radius: 16px;
}

</style>

