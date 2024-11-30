import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

const app = createApp(App)

// create global variable for API URL
app.config.globalProperties.$apiUrl = import.meta.env.VITE_API_URL

app.use(createPinia())
app.use(router)

app.mount('#app')
