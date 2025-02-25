import './bootstrap'; // Import your Laravel bootstrap.js setup
import '../css/app.css';
import '../css/demoassets/applayouts.css';

// Vue 3 setup
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import "vue-toastification/dist/index.css";
import Toast from "vue-toastification";
import PrimeVue from 'primevue/config';
import Skeleton from 'primevue/skeleton';
import Aura from '@primevue/themes/aura';
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import { aliases, mdi } from 'vuetify/iconsets/mdi';
import Vue3Marquee from 'vue3-marquee';
import { createPinia } from 'pinia';

// Importing Echo and Pusher
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Access environment variables from Vite
const appKey = import.meta.env.VITE_PUSHER_APP_KEY;
const appCluster = import.meta.env.VITE_PUSHER_APP_CLUSTER;

// Debugging output to ensure variables are loaded correctly
console.log('Pusher App Key:', appKey);
console.log('Pusher App Cluster:', appCluster);

// Initialize Echo with Pusher
const echo = new Echo({
    broadcaster: 'pusher',
    key: appKey,
    cluster: appCluster,
    forceTLS: true
});

// Import vue-multiselect for usage across your app
import VueMultiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.css';

// Create Pinia store instance
const pinia = createPinia();

// Vuetify configuration
const vuetify = createVuetify({
  icons: {
    defaultSet: 'mdi',
    aliases,
    sets: {
      mdi,
    },
  },
  theme: {
    defaultTheme: 'light',
    themes: {
      light: {
        colors: {
          primary: '#2D2942', // Customize primary color
          secondary: '#03DAC6',
          accent: '#FF4081',
          error: '#F44336',
          warning: '#FFC107',
          info: '#2196F3',
          success: '#4CAF50',
        },
      },
      dark: {
        colors: {
          primary: '#ffe002', // Customize primary color for dark mode
          secondary: '#03DAC6',
          accent: '#FF4081',
          error: '#CF6679',
          warning: '#FFC107',
          info: '#2196F3',
          success: '#4CAF50',
        },
      },
    },
  },
});

// Inertia.js setup for your Vue 3 app
createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
    const page = pages[`./Pages/${name}.vue`];
    if (!page) {
      console.error(`Page component not found ${name}`);
    }
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(Toast)
      .use(Vue3Marquee)
      .use(pinia)
      .use(PrimeVue, {
        theme: {
          preset: Aura,
        }
      })
      .component('Skeleton', Skeleton)
      .component('vue-multiselect', VueMultiselect)
      .use(vuetify)
      .mount(el);
  },
});
