import './bootstrap';
import { createApp } from 'vue';

/* COMPONENTES GLOBALES */
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import Vue3Toastify from "vue3-toastify";
import 'vue3-toastify/dist/index.css';
/* COMPONENTES GLOBALES */

/* IMPORT DASHBOARD INICIO */
import DashboardInicioIndex from "./views/dashboard/inicio/InicioIndex.vue";
/* IMPORT DASHBOARD INICIO */

/* IMPORT DASHBOARD USUARIO */
import DashboardUsuarioIndex from "./views/dashboard/usuario/UsuarioIndex.vue";
/* IMPORT DASHBOARD USUARIO */

/* IMPORT DASHBOARD CATEGORIAS */
import DashboardCategoriaIndex from "./views/dashboard/categoria/CategoriaIndex.vue";
import DashboardCategoriaCrear from "./views/dashboard/categoria/CategoriaCrear.vue";
import DashboardCategoriaEditar from "./views/dashboard/categoria/CategoriaEditar.vue";
/* IMPORT DASHBOARD CATEGORIAS */

const app = createApp({});

/*  COMPONENTES GLOBALES*/
app.component("Bootstrap5Pagination",Bootstrap5Pagination);
app.component("vSelect",vSelect);
/*  COMPONENTES GLOBALES*/

/* INICIO DASHBOARD COMPONENTES */
app.component("DashboardInicioIndex",DashboardInicioIndex);
/* INICIO DASHBOARD COMPONENTES */

/* USUARIO DASHBOARD COMPONENTES */
app.component("DashboardUsuarioIndex",DashboardUsuarioIndex);
/* USUARIO DASHBOARD COMPONENTES */

/* CATEGORIA DASHBOARD COMPONENTES */
app.component("DashboardCategoriaIndex",DashboardCategoriaIndex);
app.component("DashboardCategoriaCrear",DashboardCategoriaCrear);
app.component("DashboardCategoriaEditar",DashboardCategoriaEditar);
/* CATEGORIA DASHBOARD COMPONENTES */

/* CONFIG PLUGINS*/
app.use(Vue3Toastify,{
    autoClose: 3000,
    closeOnClick:true,
    position:"top-right"
})
/* CONFIG PLUGINS*/

app.mount("#app");

