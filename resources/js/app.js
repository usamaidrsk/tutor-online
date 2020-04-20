const Vue = require('vue')
const axios = require('axios')
const App = require('./App.vue').default
const route = require('./route')

require('./components')
require('./pages')

const root = document.getElementById('app')
const { dataset } = root

axios.defaults.headers.common['X-CSRF-TOKEN'] = dataset.csrfToken
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
Vue.prototype.$http = axios

Vue.prototype.$auth = JSON.parse(dataset.auth)
Vue.prototype.route = route

Vue.config.productionTip = false

const Page = Vue.component(dataset.pageName.replace('.', '-'))
const props = JSON.parse(dataset.routeData) || {}

const app = new Vue({
    el: root,
    render: h => h(App, { scopedSlots: { default: () => h(Page, { props }) } }),
})
