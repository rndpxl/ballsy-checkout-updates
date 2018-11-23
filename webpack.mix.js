const mix = require('laravel-mix');
require('dotenv').config();

let proxy_url = process.env.APP_URL || 'http://localhost:8000';

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix//.react('resources/js/app.js', 'public/js')
    .js('resources/js/referral_modal.js','public/js/referral_modal.js')
    .sass('resources/sass/micromodal.scss', 'public/css/micromodal.css')
   //.sass('resources/sass/app.scss', 'public/css');

mix.browserSync(proxy_url);