import "./bootstrap";
import { createApp } from "vue";
import Main from "./Main.vue";

// const router = new VueRouter({
//     mode: "history", 
//     // base: process.env.BASE_URL,
//     routes,
// });

// Vue.config.productionTip = false;

// Vue.use(VueRouter);

// app = new Vue({
//     router, // Use the router configuration
//     render: (h) => h(App),
// }).$mount("#app");

const app = createApp();
app.component("Mainapp", Main);
app.mount("#app");

// import {VueRouter} from 'vue-router';

// Vue.use(Router);

// Vue.config.productionTip = false;

// new Vue({
//   router, // Use the router configuration
//   render: h => h(App),
// }).$mount('#app');

// const app = createApp();

// app.component("Mainapp", Main);

// app.mount("#app");

// export default new VueRouter({
//     routes: [
//         {
//             path: "/login",
//             component: Login,
//         },
//         {
//             path: "/register",
//             component: Register,
//         },
//         // {
//         //     path: "/dashboard",
//         //     component: Dashboard,
//         //     beforeEnter: requireAuth,
//         // },
//     ],
// });
