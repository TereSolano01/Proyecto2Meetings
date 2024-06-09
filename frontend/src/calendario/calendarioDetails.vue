<template>
  <div class="row">
    <div class="eleven column">
      <h2>{{ title }}</h2>
      <form id="myForm">
        <div class="row">
          <div class="six columns">
            <label id="label" for="tituloInput">Titulo</label>
            <input class="u-full-width" type="text" v-model="calendar.titulo">
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <label id="label" for="descripcionInput">Descripcion</label>
            <input class="u-full-width" type="text" v-model="calendar.descripcion">
          </div>
        </div>
        <div class="row">
          <div class="six columns">
            <label id="label" for="fechaInput">Fecha</label>
            <input class="u-full-width" type="date" v-model="fecha" @input="updateFecha">
          </div>
          <div class="six columns">
            <label id="label" for="horaInicioInput">Hora de Inicio</label>
            <input class="u-full-width" type="time" v-model="calendar.hora_inicio">
          </div>
        </div>
        <div class="row">
          <div class="six columns">
            <label id="label" for="horaFinInput">Hora de Fin</label>
            <input class="u-full-width" type="time" v-model="calendar.hora_fin">
          </div>
          <div class="six columns">
            <label id="label" for="ubicacionInput">Ubicación</label>
            <input class="u-full-width" type="text" v-model="calendar.ubicacion">
          </div>
        </div>
        <router-link class="button button-primary" to="/calendario">Back</router-link>
        <a v-if='edit' class="button button-primary" style="float: right" v-on:click="updateCalendario">Update</a>
        <a v-if='create' class="button button-primary" style="float: right" v-on:click="createCalendario">Create</a>
        <button v-if='show' class="button button-primary" style="margin-top: 10px;" @click="shareMeeting">Share Meeting</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['create', 'edit', 'show'],
  data: function() {
    return {
      title: "Reuniones data",
      calendar: {
        id: '',
        titulo: '',
        descripcion: '',
        dia: '',
        mes: '',
        anio: '',
        hora_inicio: '',
        hora_fin: '',
        ubicacion: '',
        user_id: ''
      },
      fecha: ''
    }
  },
  created() {
    if (this.$route.params.id) {
      this.fetchCalendario(this.$route.params.id);
    }
  },
  watch: {
    'calendar.dia': 'updateFechaModel',
    'calendar.mes': 'updateFechaModel',
    'calendar.anio': 'updateFechaModel'
  },
  methods: {
    fetchCalendario(id) {
      axios.get(`https://calendarmeetings.000webhostapp.com/server/calendario/${id}`)
        .then(response => {
          if (Array.isArray(response.data) && response.data.length > 0) {
            this.calendar = response.data[0];
            this.fecha = `${this.calendar.anio}-${String(this.calendar.mes).padStart(2, '0')}-${String(this.calendar.dia).padStart(2, '0')}`;
          }
        })
        .catch(error => {
          console.error('There was an error fetching the calendario!', error);
        });
    },

    async updateCalendario() {
      const eventId = this.$route.params.id;
      try {
        const response = await axios.put(`https://calendarmeetings.000webhostapp.com/server/calendario/${eventId}`, {
          titulo: this.calendar.titulo,
          descripcion: this.calendar.descripcion,
          dia: this.calendar.dia,
          mes: this.calendar.mes,
          anio: this.calendar.anio,
          hora_inicio: this.calendar.hora_inicio,
          hora_fin: this.calendar.hora_fin,
          ubicacion: this.calendar.ubicacion,
          user_id: this.calendar.user_id
        });

        if (response.status === 200) {
          console.log('Datos actualizados');
          this.$router.push('/calendario');
        } else {
          console.error('Update failed:', response.data);
        }
      } catch (error) {
        console.error('Update error:', error.message);
      }
    },

    async createEvento() {
      const fechaParts = this.evento.fecha.split('-');
      const dia = parseInt(fechaParts[2]);
      const mes = parseInt(fechaParts[1]);
      const anio = parseInt(fechaParts[0]);
      
      const userId = parseInt(localStorage.getItem('userId'));

        try {
          const response = await axios.post('https://calendarmeetings.000webhostapp.com/server/calendario', {
            titulo: this.evento.titulo,
            descripcion: this.evento.descripcion,
            dia: dia,
            mes: mes,
            anio: anio,
            hora_inicio: this.evento.hora_inicio,
            hora_fin: this.evento.hora_fin,
            ubicacion: this.evento.ubicacion,
            user_id: userId
          });
  
          if (response.data && response.data.message) {
            this.evento = {
              titulo: '',
              descripcion: '',
              fecha: '',
              hora_inicio: '',
              hora_fin: '',
              ubicacion: ''
            };
            this.$router.push('/calendario');
          } else {
            window.location.href = '/calendario';
          }
        } catch (error) {
          if (error.response && error.response.data && error.response.data.error) {
            console.error('Error en la solicitud:', error.response.data.error);
          } else {
            console.error('Error de comunicación con el servidor:', error.message);
          }
        }
      },

    updateFecha() {
      const [anio, mes, dia] = this.fecha.split('-');
      this.calendar.anio = anio;
      this.calendar.mes = mes;
      this.calendar.dia = dia;
    },

    updateFechaModel() {
      if (this.calendar.anio && this.calendar.mes && this.calendar.dia) {
        this.fecha = `${this.calendar.anio}-${String(this.calendar.mes).padStart(2, '0')}-${String(this.calendar.dia).padStart(2, '0')}`;
      }
    },

    shareMeeting() {
      this.$router.push({ path: `/calendario/share/${this.calendar.id}`, props: { calendar: this.calendar } });
    }
  }
}
</script>

<style scoped>
#myForm {
  width: 35%;
  margin: 0 auto; 
}

#label{
  text-align: center !important;
}
</style>
