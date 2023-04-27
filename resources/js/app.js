import './bootstrap';
import { createApp } from 'vue';
import 'jquery/dist/jquery'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'

import app from './AppLayout.vue'
import router from './router'

createApp(app)
    .use(router)
    .mount("#app")
