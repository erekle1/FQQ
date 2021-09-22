import {createApp} from 'vue'

require('./bootstrap')
import App from './Layouts/App.vue'
import axios from 'axios'
import router from './routes'

const app = createApp(App)
app.config.globalProperties.$axios = axios;
app.use(router)
app.mount('#app')
