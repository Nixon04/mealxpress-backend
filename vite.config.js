import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import vuetify from 'vite-plugin-vuetify';
import ip from 'ip'
export default defineConfig({
    build: {
        chunkSizeWarningLimit: 1600, // Adjust the limit as necessary
        rollupOptions: {
            output: {
                manualChunks(id) {
                    // Create separate chunks for node_modules
                    if (id.includes('node_modules')) {
                        return id.split('node_modules/')[1].split('/')[0]; // Chunk by package name
                    }
                }
            }
        }
    },

    

    plugins: [
        vue(),
        vuetify({ autoImport: true }) ,
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],

    server:{
        host:  ip.address(),
        port: 5713
    }

});
