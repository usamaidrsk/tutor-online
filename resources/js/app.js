import Vue from 'vue'
import axios from 'axios'
import App from './App.vue'
import ErrorBag from './ErrorBag'

import './components'
import './pages'

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

Vue.config.productionTip = false

const Page = Vue.component(dataset.pageName.replace('.', '-'))
const props = JSON.parse(dataset.routeData) || {}

const app = new Vue({
    el: root,
    render: h => h(App, { scopedSlots: { default: () => h(Page, { props }) } }),
})
