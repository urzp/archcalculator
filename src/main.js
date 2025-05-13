import './servis/prototypes.js'
import './assets/css/main.css'
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import components from './components'
import { text } from '@/servis/text.js'

import { QuillEditor } from '@vueup/vue-quill'
//import '@vueup/vue-quill/dist/vue-quill.snow.css';

window.text = text

const app = createApp(App)

components.forEach(component => {
    app.component(component.name, component)
})

app.component('QuillEditor', QuillEditor)

app.use(store)

app.use(router)

app.mount('#app')
