import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        })
    ], server: {
        host:'0.0.0.0',
        port:5173,
        hmr: {
            host: '127.0.0.1',
        },
    },
    
});
