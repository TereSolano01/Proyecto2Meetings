<template>
    <div>
      <h2>{{ title }}</h2>
      <form @submit.prevent="createEvento">
        <div class="row">
          <div class="six columns">
            <label for="titulo">Título</label>
            <input class="u-full-width" type="text" v-model="evento.titulo">
          </div>
          <div class="six columns">
            <label for="descripcion">Descripción</label>
            <input class="u-full-width" type="text" v-model="evento.descripcion">
          </div>
        </div>
        <div class="row">
          <div class="six columns">
            <label for="fecha">Fecha</label>
            <input class="u-full-width" type="date" v-model="evento.fecha">
          </div>
          <div class="three columns">
            <label for="hora_inicio">Hora de Inicio</label>
            <input class="u-full-width" type="time" v-model="evento.hora_inicio">
          </div>
          <div class="three columns">
            <label for="hora_fin">Hora de Finalización</label>
            <input class="u-full-width" type="time" v-model="evento.hora_fin">
          </div>
        </div>
        <div class="row">
          <div class="six columns">
            <label for="ubicacion">Ubicación</label>
            <input class="u-full-width" type="text" v-model="evento.ubicacion">
          </div>
        </div>
        <button class="button-primary" type="submit">Crear</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'CreateEvento',
    props: {
      userId: {
        type: Number,
        required: true
      }
    },
    data() {
      return {
        title: 'Crear Evento',
        evento: {
          titulo: '',
          descripcion: '',
          fecha: '',
          hora_inicio: '',
          hora_fin: '',
          ubicacion: ''
        }
      };
    },
    methods: {
      async createEvento() {
      if (this.evento.hora_inicio >= this.evento.hora_fin) {
        console.error('La hora de finalización debe ser posterior a la hora de inicio.');
        return; 
      }

      const fechaParts = this.evento.fecha.split('-');
      const dia = parseInt(fechaParts[2]);
      const mes = parseInt(fechaParts[1]);
      const anio = parseInt(fechaParts[0]);
      
      const userId = parseInt(localStorage.getItem('userId'));

        try {
          const response = await axios.post('https://meetingscalendar.000webhostapp.com/server/calendario', {
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
      }
    }
  };
  </script>
  