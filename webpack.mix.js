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

// Flundr Build Process
//mix.js('resources/js/flundr.js', 'public/styles/js/flundr').extract(['lodash','axios','vue']);

mix.scripts(['resources/js/preview.js', 'node_modules/flickity/dist/flickity.pkgd.js'], 'public/styles/js/lr-ticker.js');

mix.styles([
    'resources/css/default/defaults.css',
    'resources/css/liveticker.css',
	'resources/css/auth.css',
	'node_modules/flickity/dist/flickity.css'
], 'public/styles/css/main.css')
	.styles([
    'resources/css/default/defaults.css',
    'resources/css/adminarea.css'
], 'public/styles/css/admin.css')
	.styles([
    'resources/css/default/defaults.css',
    'resources/css/preview.css'
], 'public/styles/css/tickerembed.css');

mix.copyDirectory('resources/img', 'public/styles/img');
mix.copyDirectory('node_modules/tinymce/skins', 'public/styles/libs/tiny/skins');