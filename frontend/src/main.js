// src/main.js
import { createApp } from 'vue';

import { createRouter, createWebHistory } from 'vue-router'
import App from './App.vue'

import '../css/normalize.css';
import '../css/skeleton.css';

import professorIndex from './professor/professorIndex.vue'
import professorDetails from './professor/professorDetails.vue'
import calendarioIndex from './calendario/calendarioIndex.vue'
import calendarioDetails from './calendario/calendarioDetails.vue'


const routes = [
  { path: '/professor', component: professorIndex, props: true},
  { path: '/professor/show/:id', component: professorDetails, props: {show: true}},
  { path: '/professor/edit/:id', component: professorDetails, props: {edit: true}},
  { path: '/professor/create', component: professorDetails, props: {create: true}},
  { path: '/professor/delete/:id', component: professorDetails, props: {delete: true}},
  { path: '/calendario', component: calendarioIndex, props: true},
  { path: '/calendario/show/:id', component: calendarioDetails, props: {show: true}},
  { path: '/calendario/edit/:id', component: calendarioDetails, props: {edit: true}},
  { path: '/calendario/create', component: calendarioDetails, props: {create: true}},
  { path: '/calendario/delete/:id', component: calendarioDetails, props: {delete: true}},
  { path: '/', component: professorIndex, props: true},
]


const router = createRouter({
  history: createWebHistory(),
  routes: routes
})

const app = createApp(App)

app.use(router)

app.mount('#app')