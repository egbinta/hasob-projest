require('./bootstrap');

import { createApp } from 'vue'
import Home from './components/Home.vue'
import router from './router/index'
import 'bootstrap/dist/css/bootstrap.min.css'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js' 

createApp(Home).use(router).mount('#app')

