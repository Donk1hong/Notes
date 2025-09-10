import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/main-style.css',
                'resources/css/account-style.css',
                'resources/js/noteCard.js',
                'resources/css/error-style.css'
            ],
            refresh: true,
        }),
    ],
});
