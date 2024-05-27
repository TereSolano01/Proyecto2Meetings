<template>
    <div class="row">
      <div style="margin-top: 5%">
        <h2>{{ title }}</h2>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Degree</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="prof in professors" :key="prof.id">
              <td>{{ prof.name }}</td>
              <td>{{ prof.degree }}</td>
              <td>{{ prof.email }}</td>
              <td>{{ prof.phone }}</td>
              <td>
                <router-link class="button" :to="'/professor/show/' + prof.id">Show</router-link>
                <router-link class="button" :to="'/professor/edit/' + prof.id">Edit</router-link>
                <a class="button" @click="deleteProfessor(prof.id)">Erase</a>
              </td>
            </tr>
          </tbody>
        </table>
        <router-link class="button button-primary" to="/professor/create">New</router-link>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        title: 'Professor List',
        professors: []
      };
    },
    created() {
      this.allProfessor();
    },
    methods: {
        async allProfessor() {
    try {
      const response = await axios.get('https://meetingscalendar.000webhostapp.com/server/professor', {
        headers: { 'Accept': 'application/json' }
      });
      console.log('Response data:', response.data); // Agrega esto
      this.professors = response.data;
    } catch (error) {
      console.error('Error fetching professors:', error);
    }
  },
      async deleteProfessor(id) {
        try {
          await axios.post(`https://meetingscalendar.000webhostapp.com/server/professor/${id}`, {
            _method: 'DELETE'
          }, {
            headers: { 'Content-Type': 'application/json' }
          });
          this.allProfessor();
        } catch (error) {
          console.error('Error deleting professor:', error);
        }
      }
    }
  };
  </script>
  
  <style scoped>
  /* Puedes agregar tus estilos aquí */
  </style>
  