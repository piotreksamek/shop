import { createApp } from 'vue'
import 'bootstrap/dist/css/bootstrap.css';
import BootstrapVue3 from 'bootstrap-vue-3'
import 'bootstrap-icons/font/bootstrap-icons.css'
import App from './App.vue'
import router from "./router";

createApp(App)
    .use(router)
    .use(BootstrapVue3)
    .mount('#app')
