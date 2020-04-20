import Vue from 'vue'

const files = require.context('./', false, /\.vue$/, 'lazy')

files.keys().forEach(key => {
    Vue.component(
        key.slice(key.lastIndexOf('/') + 1, key.lastIndexOf('.')),
        () => files(key)
    )
})
