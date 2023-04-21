
import './bootstrap';
import { createApp } from 'vue';

import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import VueSweetalert2 from 'vue-sweetalert2';
import router from './router';

import App from './components/App.vue';

const app = createApp(App);

app.component('VueDatePicker', VueDatePicker);

app.use(router)
app.use(VueSweetalert2);
app.mount('#app');
