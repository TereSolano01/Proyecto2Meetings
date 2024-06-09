<!-- src/calendario/ShareMeeting.vue -->
<template>
  <div>
    <h2>Share Meeting</h2>
    <form @submit.prevent="shareMeeting">
      <div>
        <label for="email">Recipient Email:</label>
        <input type="email" v-model="email" required />
      </div>
      <button type="submit">Share Meeting</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['calendar'],
  data() {
    return {
      email: '',
    };
  },
  methods: {
    async shareMeeting() {
      try {
        const response = await axios.post('https://calendarmeetings.000webhostapp.com/server/shareMeeting', {
          calendar: this.calendar,
          email: this.email,
        });

        if (response.data && response.data.message) {
          alert('Meeting shared successfully');
        } else {
          alert('Failed to share meeting');
        }
      } catch (error) {
        console.error('Error sharing meeting:', error);
        alert('Failed to share meeting');
      }
    },
  },
};
</script>

<style scoped>
/* Add your styles here */
</style>
