const mix = require('laravel-mix')
const path = require('path')

mix.webpackConfig({
    output: {
        chunkFilename: 'js/chunks/[id].chunk.[chunkhash].js',
        publicPath: '/',
    },
    resolve: {
        alias: {
            '@': path.resolve('resources/'),
        },
    },
})

mix.js('resources/js/app.js', 'public/js')
    // .extract(['vue', 'axios'])
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps(!mix.inProduction(), 'source-map')
    .version()

mix.disableNotifications()
