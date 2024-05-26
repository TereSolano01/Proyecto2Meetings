<!-- src/App.vue -->
<template>
  <div id="app" class="container">
    <div class="row" style="margin-top: 5%">
      <router-link class="button button-primary" 
       style="margin-right: 10px;" to="/professor">Professors
      </router-link> 
      <router-link class="button button-primary" 
       style="margin-right: 10px;" to="/student">Students
      </router-link>
      <router-link class="button button-primary" 
       to="/course">Courses
      </router-link>
    </div>
    <router-view
      v-bind:professors="professors">
    </router-view>
  </div>
</template>

<script>
export default {
  data() {
    return {
      professors: []
    }
  }
}
</script>