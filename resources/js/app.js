import Vue from 'vue'
import axios from 'axios'
import App from './App.vue'
import ErrorBag from './ErrorBag'

window.ErrorBag = ErrorBag

const root = document.getElementById('app')
const { dataset } = root

Vue.prototype.$http = axios.create({
    baseURL: window.location.origin,
    headers: {
        'X-CSRF-TOKEN': dataset.csrfToken,
        'X-Requested-With': 'XMLHttpRequest',
    },
})

Vue.prototype.$auth = JSON.parse(dataset.auth)
Vue.prototype.route = route

const components = require.context('./components', false, /\.vue$/, 'lazy')

components.keys().forEach(key => {
    Vue.component(
        key.slice(key.lastIndexOf('/') + 1, key.lastIndexOf('.')),
        () => components(key)
    )
})

const kebabCase = string =>
    string
        .replace(/([a-z])([A-Z])/g, '$1-$2')
        .replace(/\s+/g, '-')
        .toLowerCase()

const pages = require.context('./pages', true, /\.vue$/, 'lazy')

pages.keys().forEach(key => {
    if (key.indexOf('_') > -1) return

    const filename = key.slice(key.lastIndexOf('/') + 1, key.lastIndexOf('.'))
    const path = key.slice(key.indexOf('/') + 1, key.lastIndexOf('/'))
    const name =
        (path ? path.replace(/\//g, '_') + '_' : '') + kebabCase(filename)

    Vue.component(name, () => pages(key))
})

Vue.config.productionTip = false

const Page = Vue.component(dataset.pageName.replace(/\./g, '_'))
const props = JSON.parse(dataset.routeData) || {}

const app = new Vue({
    el: root,
    render: h => h(App, { scopedSlots: { default: () => h(Page, { props }) } }),
})
