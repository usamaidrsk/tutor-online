const Vue = require('vue')

const files = require.context('./', false, /\.vue$/, 'lazy')

files.keys().forEach(key => {
    Vue.component(
        'app-' +
            key
                .toLowerCase()
                .slice(key.lastIndexOf('/') + 1, key.lastIndexOf('.')),
        () => files(key)
    )
})
