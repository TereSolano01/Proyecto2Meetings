<template>
  <div class="row">
    <div class="eleven column" style="margin-top: 5%">
      <h2>{{ title }}</h2>
      <form>
        <div class="row">
          <div class="six columns">
            <label for="tituloInput">Titulo</label>
            <input class="u-full-width" type="text" v-model="calendar.titulo">
          </div>
        </div>
        <div class="row">
          <div class="twelve columns">
            <label for="descripcionInput">Descripcion</label>
            <input class="u-full-width" type="text" v-model="calendar.descripcion">
          </div>
        </div>
        <div class="row">
          <div class="six columns">
            <label for="fechaInput">Fecha</label>
            <input class="u-full-width" type="date" v-model="fecha" @input="updateFecha">
          </div>
          <div class="six columns">
            <label for="horaInicioInput">Hora de Inicio</label>
            <input class="u-full-width" type="time" v-model="calendar.hora_inicio">
          </div>
        </div>
        <div class="row">
          <div class="six columns">
            <label for="horaFinInput">Hora de Fin</label>
            <input class="u-full-width" type="time" v-model="calendar.hora_fin">
          </div>
          <div class="six columns">
            <label for="ubicacionInput">Ubicación</label>
            <input class="u-full-width" type="text" v-model="calendar.ubicacion">
          </div>
        </div>
        <router-link class="button button-primary" to="/calendario">Back</router-link>
        <a v-if='edit' class="button button-primary" style="float: right" v-on:click="updateCalendario()">Update</a>
        <a v-if='create' class="button button-primary" style="float: right" v-on:click="createCalendario()">Create</a>
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
    fetchCalendario: function(id) {
      axios.get(`https://meetingscalendar.000webhostapp.com/server/calendario/${id}`)
        .then(response => {
          console.log('Datos recibidos:', response.data);
          if (Array.isArray(response.data) && response.data.length > 0) {
            this.calendar = response.data[0];
            this.fecha = `${this.calendar.anio}-${String(this.calendar.mes).padStart(2, '0')}-${String(this.calendar.dia).padStart(2, '0')}`;
          }
        })
        .catch(error => {
          console.error('There was an error fetching the calendario!', error);
        });
    },
    updateCalendario: function() {
      this.calendar['_method'] = 'PUT';
      var id = this.$route.params.id;
      axios.post(`https://meetingscalendar.000webhostapp.com/server/calendario/${id}`, this.calendar, {
        headers: { 'Content-Type': 'application/json' }
      })
        .then(() => {
          this.$router.push('/calendario');
        })
        .catch(error => {
          console.error('There was an error updating the calendario!', error);
        });
    },
    createCalendario: function() {
      axios.post('https://meetingscalendar.000webhostapp.com/server/calendario', this.calendar, {
        headers: { 'Content-Type': 'application/json' }
      })
        .then(() => {
          this.$router.push('/calendario');
        })
        .catch(error => {
          console.error('There was an error creating the calendario!', error);
        });
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
    }
  }
}
</script>
