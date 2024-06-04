<template>
  <div class="row" style="padding-top: 12px; margin-bottom: 20px; background: #161B33;">
    <div class="leftOptions twelve columns">
      <router-link to="/" class="button button-primary">Home</router-link>
      <router-link v-if="loggedIn" to="/calendario" class="button button-primary">Reuniones</router-link>
      <button v-if="loggedIn" @click="logout" class="button logoutBtn" style="float: right">Logout</button>
      <router-link v-else to="/login" class="button" style="float: right">Login</router-link>
    </div>
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
    async checkLoggedIn() {
      const userId = localStorage.getItem('userId');
      this.loggedIn = !!userId;
    },
    async logout() {
      localStorage.removeItem('userId');
      this.loggedIn = false;
      await this.$router.push('/login');
    }
  },
  async mounted() {
    await this.checkLoggedIn();
  },
  watch: {
    async $route() {
      await this.checkLoggedIn();
    }
  }
};
</script>

<link rel="stylesheet" href="/css/navBar.css" />
