import './bootstrap';

import { createApp } from 'vue'
import Main from './Main.vue'


const app = createApp()

app.component('Mainapp', Main )

app.mount('#app')



