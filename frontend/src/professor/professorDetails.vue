<!-- professorDetails.vue -->
<template>
  <div class="row">
   <div class="eleven column" style="margin-top: 5%">
    <h2>{{title}}</h2>
     <form>
     <div class="row">
      <div class="six columns">
       <label for="nameInput">Name</label>
       <input class="u-full-width" type="text"
         v-model="prof.name">
      </div>
      <div class="six columns">
       <label for="degreeInput">Degree</label>
       <input class="u-full-width" type="text"
          v-model="prof.degree">
      </div>
     </div>
     <div class="row">
      <div class="six columns">
       <label for="emailInput">Email</label>
       <input class="u-full-width" type="email"
          v-model="prof.email">
      </div>
      <div class="six columns">
       <label for="phoneInput">Phone</label>
       <input class="u-full-width" type="tel"
         v-model="prof.phone">
      </div>
      <router-link class="button button-primary" 
        to="/professor">Back</router-link>
      <a v-if='edit' class="button button-primary" style="float: right"
         v-on:click="updateProfessor()">Update</a>
      <a v-if='create' class="button button-primary" style="float: right"
         v-on:click="createProfessor()">Create</a>
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
      title: "Professor Data",
      prof: {'name':'','degree':'','phone':'','email':''},
    }
  },
  created () {
   this.findProfessor(app.$route.params.id)
  },
  methods: {
    findProfessor: function(id) {
      var prof = app.professors.find(
        function(x) { return x.id == id; });
      if (prof!=null)
        Object.assign(this.prof,prof);
    },
    updateProfessor: function() {
      this.prof['_method'] = 'PUT';
      var id = app.$route.params.id;
      fetch('/server/professor/'+id,
        { headers: {'Content-Type':'application/json'},
          method: 'POST',
          body: JSON.stringify(this.prof)})
        .then((data) => {
          var index = app.professors.findIndex(
             function(x) { return x.id == id; });
          app.professors[index] = this.prof;
          router.push('/professor');
        }
      )
    },
    createProfessor: function() {
      fetch('/server/professor',
        { headers: {'Content-Type':'application/json'},
          method: 'POST',
          body: JSON.stringify(this.prof)})
        .then((data) => {
           app.professors.push(this.prof);
           router.push('/professor');
        }
      )
    }
  }
}
</script>