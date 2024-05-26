<!-- professorDetails.vue -->
<template>
  <div class="row">
   <div class="eleven column" style="margin-top: 5%">
    <h2>{{title}}</h2>
     <form>
     <div class="row">
      <div class="six columns">
    <label for="nameInput">Titulo</label>
    <input class="u-full-width" type="text" v-model="calendar.titulo">
  </div>
  <div class="six columns">
    <label for="degreeInput">Descripcion</label>
    <input class="u-full-width" type="text" v-model="calendar.descripcion">
  </div>
</div>
<div class="row">
  <div class="six columns">
    <label for="emailInput">Dia</label>
    <input class="u-full-width" type="text" v-model="calendar.dia">
  </div>
  <div class="six columns">
    <label for="phoneInput">Mes</label>
    <input class="u-full-width" type="text" v-model="calendar.mes">
  </div>
      <router-link class="button button-primary" 
        to="/calendario">Back</router-link>
      <a v-if='edit' class="button button-primary" style="float: right"
         v-on:click="updateCalendario()">Update</a>
      <a v-if='create' class="button button-primary" style="float: right"
         v-on:click="createCalendario()">Create</a>
     </div>
    </form>
   </div>
  </div>
</template>

<script>
export default {
  props: ['create','edit','show'],
  data: function() {
    return {
      title: "Reuniones data",
      calend: {'id':'','titulo':'','descripcion':'','dia':'','mes':'','anio':'','hora_inicio':'','hora_fin':'','ubicacion':'','user_id':''},
    }
  },
  created () {
   this.findCalendario(app.$route.params.id)
  },
  methods: {
    findCalendario: function(id) {
      var calend = app.calendarios.find(
        function(x) { return x.id == id; });
      if (calend!=null)
        Object.assign(this.calend,calend);
    },
    updateCalendario: function() {
      this.calend['_method'] = 'PUT';
      var id = app.$route.params.id;
      fetch('/server/calendario/'+id,
        { headers: {'Content-Type':'application/json'},
          method: 'POST',
          body: JSON.stringify(this.calend)})
        .then((data) => {
          var index = app.calendarios.findIndex(
             function(x) { return x.id == id; });
          app.calendarios[index] = this.calend;
          router.push('/calendario');
        }
      )
    },
    createCalendario: function() {
      fetch('/server/calendario',
        { headers: {'Content-Type':'application/json'},
          method: 'POST',
          body: JSON.stringify(this.calend)})
        .then((data) => {
           app.calendarios.push(this.calend);
           router.push('/profecalendariossor');
        }
      )
    }
  }
}
</script>