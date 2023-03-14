import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/css_perso.css',
                'resources/css/ad_form.css',
                'resources/css/welcome_page.scss',
                'resources/js/app.js',
                'resources/js/perso.js',
                'resources/js/confirmationModal.js',
                'resources/js/api_ville.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
});
