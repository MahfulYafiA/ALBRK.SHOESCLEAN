import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            publicDirectory: '../public',
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                '../app/**/*.php',
                '../backend/**/*.php',
                '../routes/**/*.php',
                'views/**/*.blade.php',
            ],
        }),
        tailwindcss(),
    ],
    server: {
        proxy: {
            '^/(?!@vite|resources|node_modules|build|favicon\\.ico)': {
                target: 'http://127.0.0.1:8000',
                changeOrigin: true,
            },
        },
        watch: {
            ignored: ['../storage/framework/views/**'],
        },
    },
});
