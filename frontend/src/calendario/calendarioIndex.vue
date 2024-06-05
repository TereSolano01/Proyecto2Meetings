<template>
  <div class="row">
    <div>
      <h2>{{ title }}</h2>
      <table>
        <thead>
          <tr>
            <th>titulo</th>
            <th>descripcion</th>
            <th>dia</th>
            <th>mes</th>
            <th>anio</th>
            <th>hora_inicio</th>
            <th>hora_fin</th>
            <th>ubicacion</th>
            <th>user_id</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="calend in calendarios" :key="calend.id">
            <td>{{ calend.titulo }}</td>
            <td>{{ calend.descripcion }}</td>
            <td>{{ calend.dia }}</td>
            <td>{{ calend.mes }}</td>
            <td>{{ calend.anio }}</td>
            <td>{{ calend.hora_inicio }}</td>
            <td>{{ calend.hora_fin }}</td>
            <td>{{ calend.ubicacion }}</td>
            <td>{{ calend.user_id }}</td>
            <td>
              <router-link class="button" :to="'/calendario/show/' + calend.id">Show</router-link>
              <router-link class="button" :to="'/calendario/edit/' + calend.id">Edit</router-link>
              <a class="button" @click="deleteCalendario(calend.id)">Erase</a>
            </td>
          </tr>
        </tbody>
      </table>
      <router-link class="button button-primary" to="/calendario/create">New</router-link>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      title: 'Reuniones',
      calendarios: []
    };
  },
  created() {
    this.allCalendario();
  },
  methods: {
    async allCalendario() {
      try {
        const response = await axios.get('https://meetingscalendar.000webhostapp.com/server/calendario', {
          headers: { 'Accept': 'application/json' },
        });
        const userId = localStorage.getItem('userId');
        if (userId) {
          this.calendarios = response.data.filter(calend => calend.user_id == userId);
        } else {
          this.calendarios = [];
        }
      } catch (error) {
        console.error('Error fetching calendarios:', error);
      }
    },
    async deleteCalendario(id) {
      const https = require('https');
  try {
    const agent = new https.Agent({ 
      rejectUnauthorized: false,
      http2: false
    });

    const response = await axios.delete(`https://meetingscalendar.000webhostapp.com/server/calendario/${id}`, {
      headers: {
        'Content-Type': 'application/json',
      },
      httpsAgent: agent 
    });
    console.log('Solicitud DELETE exitosa:', response.data);
  } catch (error) {
    console.error('Error al realizar la solicitud DELETE:', error.message);
  }
}
  }
};
</script>
