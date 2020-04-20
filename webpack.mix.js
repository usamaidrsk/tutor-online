const mix = require('laravel-mix')

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

mix.options({
    extractVueStyles: true,
    globalVueStyles: 'resources/sass/_globals.scss',
})

    // .extract(['vue', 'axios'])
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps(!mix.inProduction(), 'source-map')
    .version()

mix.disableNotifications()
