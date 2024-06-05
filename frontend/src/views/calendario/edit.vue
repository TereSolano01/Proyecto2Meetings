<template>
  <div>
    <h2>{{ title }}</h2>
    <form @submit.prevent="updateEvento">
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
      <button class="button-primary" type="submit">Actualizar</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'EditEvento',
  props: {
    userId: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      title: 'Editar Evento',
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
  async mounted() {
    const eventId = this.$route.params.id;
    try {
      const response = await axios.get(`https://meetingscalendar.000webhostapp.com/server/calendario/${eventId}`);
      if (response.data && response.data.length > 0) {
        this.evento = response.data[0];
      } else {
        console.error('No se encontró el evento con el ID:', eventId);
      }
    } catch (error) {
      console.error('Error al obtener el evento:', error.message);
    }
  },
  methods: {
    updateCalendario: function() {
      this.evento['_method'] = 'PUT';
      var id = app.$route.params.id;
      fetch('/server/calendario/'+id,
        { headers: {'Content-Type':'application/json'},
          method: 'POST',
          body: JSON.stringify(this.evento)})
        .then((data) => {
          var index = app.professors.findIndex(
             function(x) { return x.id == id; });
          app.calendars[index] = this.evento;
          router.push('/calendario');
        }
      )
    },
  }
};
</script>

<!-- Manten los estilos importados si los necesitas -->
<link rel="stylesheet" href="/css/normalize.css">
<link rel="stylesheet" href="/css/skeleton.css">
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/footer.css" />
