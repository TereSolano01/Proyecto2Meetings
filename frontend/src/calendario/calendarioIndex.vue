<template>
  <div class="row">
    <div class="table-container"> 
      <h2 style="padding-bottom: 1%;">{{ title }}</h2>
      <table class="custom-table"> 
        <thead>
          <tr>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Dia</th>
            <th>Mes</th>
            <th>Año</th>
            <th>Hora inicio</th>
            <th>Hora fin</th>
            <th>Ubicacion</th>
            <th>Acciones</th>
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
        const response = await axios.get('https://calendarmeetings.000webhostapp.com/server/calendario', {
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

    const response = await axios.delete(`https://calendarmeetings.000webhostapp.com/server/calendario/${id}`, {
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

<style scoped>
.table-container {
  width: 65%;
  margin: 0 auto;
}

.custom-table {
  width: 100%;
}
</style>