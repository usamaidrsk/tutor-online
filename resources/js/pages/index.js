const Vue = require('vue')

const files = require.context('./', true, /\.vue$/, 'lazy')

files.keys().forEach(key => {
    Vue.component(
        key
            .slice(key.indexOf('/') + 1, key.lastIndexOf('.'))
            .toLowerCase()
            .replace('/', '-'),
        () => files(key)
    )
})
