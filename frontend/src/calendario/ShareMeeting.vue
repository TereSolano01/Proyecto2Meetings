<template>
  <div class="row">
    <div class="eleven column">
      <h2>{{ title }}</h2>
      <form id="myForm" @submit.prevent="shareMeeting">
        <div class="grid-container">
          <label id="label" for="tituloInput">Titulo</label>
          <input class="u-full-width" type="text" v-model="calendar.titulo" disabled>

          <label id="label" for="descripcionInput">Descripcion</label>
          <input class="u-full-width" type="text" v-model="calendar.descripcion" disabled>

          <label id="label" for="fechaInput">Fecha</label>
          <input class="u-full-width" type="date" v-model="fecha" disabled>

          <label id="label" for="horaInicioInput">Hora de Inicio</label>
          <input class="u-full-width" type="time" v-model="calendar.hora_inicio" disabled>

          <label id="label" for="horaFinInput">Hora de Fin</label>
          <input class="u-full-width" type="time" v-model="calendar.hora_fin" disabled>

          <label id="label" for="ubicacionInput">Ubicación</label>
          <input class="u-full-width" type="text" v-model="calendar.ubicacion" disabled>

          <label id="label" for="emailInput">Correo Electrónico para compartir</label>
          <input class="u-full-width" type="email" v-model="email">
        </div>
        <div class="row">
          <div class="twelve columns">
            <button class="button button-primary">Compartir</button>
            <div style="background-color: white; height: 150px;"></div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>



<script>
import axios from 'axios';

export default {
  data() {
    return {
      title: 'Compartir Reunión',
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
      fecha: '',
      email: ''
    };
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
    updateFechaModel() {
      if (this.calendar.anio && this.calendar.mes && this.calendar.dia) {
        this.fecha = `${this.calendar.anio}-${String(this.calendar.mes).padStart(2, '0')}-${String(this.calendar.dia).padStart(2, '0')}`;
      }
    },
    async getUserIdByEmail(email) {
  try {
    const response = await axios.get(`https://calendarmeetings.000webhostapp.com/server/user`);
    const users = response.data;
    
    const user = users.find(user => user.email === email);
    
    if (!user) {
      console.error('No se encontró ningún usuario con el correo electrónico proporcionado');
      return null;
    }

    return user.id; 
  } catch (error) {
    console.error('Error al obtener el ID del usuario por correo electrónico:', error);
    return null;
  }
},
async shareMeeting() {
  try {
    const email = this.email.trim();
    if (!email) {
      console.error('Por favor ingresa un correo electrónico válido');
      return;
    }
    const userId = await this.getUserIdByEmail(email);
    if (!userId) {
      alert('No se encontró ningún usuario con el correo electrónico proporcionado');
      return;
    }

    console.log('ID del usuario al que se compartirá la reunión:', userId);

    const meetingData = {
      titulo: this.calendar.titulo,
      descripcion: this.calendar.descripcion,
      dia: this.calendar.dia,
      mes: this.calendar.mes,
      anio: this.calendar.anio,
      hora_inicio: this.calendar.hora_inicio,
      hora_fin: this.calendar.hora_fin,
      ubicacion: this.calendar.ubicacion,
      user_id: userId
    };

    console.log('Información de la reunión compartida:', meetingData);

    const response = await axios.post('https://calendarmeetings.000webhostapp.com/server/calendario', meetingData);

    if (response.data && response.data.message) {
  alert('Reunión compartida con éxito');
  this.$router.push('/calendario');
} else {
  console.error('Error al compartir la reunión:', response.data);
  window.location.href = '/calendario';
}

  } catch (error) {
    console.error('Error al compartir la reunión:', error);
  }
}
  }
};
</script>

<style scoped>
#myForm {
  width: 35%;
  margin: 0 auto; 
}

#label {
  text-align: center !important;
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px; 
}

label {
  margin-bottom: 5px; 
}

</style>
