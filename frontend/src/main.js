// src/main.js
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';

import '../css/footer.css';
import '../css/home.css';
import '../css/login.css';
import '../css/navBar.css';
import '../css/normalize.css';
import '../css/reuniones.css';
import '../css/show.css';
import '../css/skeleton.css';
import '../css/style.css';

import professorIndex from './professor/professorIndex.vue';
import home from './views/home.vue';
import professorDetails from './professor/professorDetails.vue';
import calendarioIndex from './calendario/calendarioIndex.vue';
import calendarioDetails from './calendario/calendarioDetails.vue';
import calendarioCreate from './views/calendario/create.vue';
import login from './views/auth/login.vue';
import registration from './views/auth/registration.vue';
import ShareMeeting from './calendario/ShareMeeting.vue'; // Importar el nuevo componente

const routes = [
  { path: '/professor', component: professorIndex, props: true },
  { path: '/professor/show/:id', component: professorDetails, props: { show: true } },
  { path: '/professor/edit/:id', component: professorDetails, props: { edit: true } },
  { path: '/professor/create', component: professorDetails, props: { create: true } },
  { path: '/professor/delete/:id', component: professorDetails, props: { delete: true } },
  { path: '/calendario', component: calendarioIndex, props: true },
  { path: '/calendario/show/:id', component: calendarioDetails, props: { show: true } },
  { path: '/calendario/edit/:id', component: calendarioDetails, props: { edit: true } },
  { path: '/calendario/create', component: calendarioCreate, props: { create: true } },
  { path: '/calendario/delete/:id', component: calendarioDetails, props: { delete: true } },
  { path: '/calendario/share/:id', component: ShareMeeting, props: true }, // Nueva ruta para compartir reuniones
  { path: '/login', component: login, props: { props: false } },
  { path: '/register', component: registration, props: { props: true } },
  { path: '/', component: home, props: true },
];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});

const app = createApp(App);

app.use(router);

app.mount('#app');
