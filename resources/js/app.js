import './bootstrap';
import '../css/app.css';
import '../css/demoassets/applayouts.css';
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

// Import vue-multiselect
import VueMultiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.css'; // Make sure to include the CSS file

const pinia = createPinia();

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
      // Register vue-multiselect globally
      .component('vue-multiselect', VueMultiselect)
      .use(vuetify)
      .mount(el);
  },
});
