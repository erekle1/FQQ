import {createApp} from 'vue'

require('./bootstrap')
import Index from './Pages/Home/Index'
import axios from 'axios'
import router from './routes'

const app = createApp(Index)

app.config.globalProperties.$axios = axios;
app.use(router)
app.mount('#app')
