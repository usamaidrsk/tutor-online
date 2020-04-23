const Vue = require('vue')

const kebabCase = string =>
    string
        .replace(/([a-z])([A-Z])/g, '$1-$2')
        .replace(/\s+/g, '-')
        .toLowerCase()

const files = require.context('./', true, /\.vue$/, 'lazy')

files.keys().forEach(key => {
    if (key.indexOf('_') > -1) return

    const filename = key.slice(key.lastIndexOf('/') + 1, key.lastIndexOf('.'))
    const path = key.slice(key.indexOf('/') + 1, key.lastIndexOf('/'))
    const name =
        (path ? path.replace(/\//g, '_') + '_' : '') + kebabCase(filename)

    Vue.component(name, () => files(key))
})
