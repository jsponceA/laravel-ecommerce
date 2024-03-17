<script setup>
import {onMounted, ref, toRef} from "vue";
import CategoriaEntidad from "@/views/dashboard/categoria/CategoriaEntidad.js";
import {toast} from "vue3-toastify";

const props = defineProps({
    categoriasPadre:{
        type:Array,
        default:[]
    },
    categoriaDataActual:{
        type:Object,
        default:{}
    }
})

const categoria = ref({...CategoriaEntidad});
const loaderModificarCategoria = ref(false);
const categoriasPadre = ref(props.categoriasPadre);
const categoriaDataActual = ref(props.categoriaDataActual);

const initialData = async () => {
    Object.keys(categoria.value).forEach((key) => {
        categoria.value[key] = categoriaDataActual.value?.[key] ?? "";
    });
};

const modificarCategoria = async () => {
    try {
        loaderModificarCategoria.value = true;
        const response = await axios.put(`/dashboard/categorias/${props.categoriaDataActual.id}`, categoria.value);
        toast.success(response.data.mensaje);
        window.location.href = "/dashboard/categorias";
    } catch (error) {
        toast.error(error.response?.data?.message || "Error en el servidor");
    } finally {
        loaderModificarCategoria.value = false;
    }
};

onMounted(async () => {
    await initialData();
});
</script>

<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                <div class="breadcrumb-wrapper breadcrumb-contacts">
                    <div>
                        <h1>MODIFICAR CATEGORIA</h1>
                        <p class="breadcrumbs">
                            <span>
                            <a href="/dashboard/inicio">Inicio</a>
                        </span>
                            <span><i class="mdi mdi-chevron-right"></i></span>
                            <a href="/dashboard/categorias">Categorias</a>

                            <span><i class="mdi mdi-chevron-right"></i></span>Modificar Categoria
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <form @submit.prevent="modificarCategoria">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between mb-4">
                    <a href="/dashboard/categorias" class="btn btn-outline-danger">CANCELAR</a>
                    <button :disabled="loaderModificarCategoria" type="submit" class="btn btn-success"> MODIFICAR</button>
                </div>
                <div class="col-md-6">
                    <label class="my-0 font-weight-medium">Categoria Padre</label>
                    <vSelect  v-model="categoria.categoria_padre_id" placeholder="[----Categorias padre----]" :options="categoriasPadre" :reduce="categoriaP => categoriaP.id" label="nombre"></vSelect>
                </div>
                <div class="col-md-6">
                    <label class="my-0 font-weight-medium">Nombre (*)</label>
                    <input v-model="categoria.nombre" type="text" class="form-control" >
                </div>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
