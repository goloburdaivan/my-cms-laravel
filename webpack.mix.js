let mix = require('laravel-mix');

mix.sass('resources/scss/app.scss', 'public/build/css')
    .setPublicPath('public')
    .version();
