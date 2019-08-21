const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/styles/js').extract(['lodash','axios','vue', 'tinymce']);

mix.styles([
    'resources/css/default/defaults.css',
    'resources/css/liveticker.css',
	'resources/css/auth.css'
], 'public/styles/css/main.css')
	.styles([
    'resources/css/default/defaults.css',
    'resources/css/adminarea.css'
], 'public/styles/css/admin.css');

mix.copyDirectory('resources/img', 'public/styles/img');
mix.copyDirectory('node_modules/tinymce/skins', 'public/styles/libs/tiny/skins');