// vite.config.js
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import path from 'path'                   // <- FALTABA

export default defineConfig({
    server: { host: true, port: 5173, strictPort: true }, // recomendado en Docker
    plugins: [
        laravel({
            // si usas Breeze, suele ser CSS + JS; con solo JS también funciona
            input: ['resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: { base: null, includeAbsolute: false },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
})