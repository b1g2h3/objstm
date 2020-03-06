require("./bootstrap");
window.Vue = require("vue");

import App from "./App.vue";
import VueRouter from "vue-router";
import VueAxios from "vue-axios";
import axios from "axios";
import CxltToastr from "cxlt-vue2-toastr";
import { routes } from "./routes";
import { store } from "./store";

const toastrConfigs = {
    position: "top right",
    showDuration: 2000,
    timeOut: 5000,
    progressBar: true
};

Vue.config.productionTip = false;
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(CxltToastr, toastrConfigs);

const router = new VueRouter({
    mode: "history",
    routes: routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.loggedIn) {
            next({
                name: "login"
            });
        } else {
            if (to.matched.some(record => record.meta.requiredInvoice)) {
                if (!store.getters.invoice) {
                    next({
                        name: "invoice"
                    });
                } else {
                    next();
                }
            } else {
                next();
            }
        }
    } else {
        next();
    }
});

const app = new Vue({
    el: "#app",
    router: router,
    store: store,
    render: h => h(App)
});
