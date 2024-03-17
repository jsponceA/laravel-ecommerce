<script setup>
import {onMounted, ref, toRef} from "vue";
import CategoriaEntidad from "@/views/dashboard/categoria/CategoriaEntidad.js";
import {toast} from "vue3-toastify";

const props = defineProps({
    categoriasPadre:{
        type:Array,
        default:[]
    }
})

const categoria = ref({...CategoriaEntidad});
const loaderGuardarCategoria = ref(false);
const categoriasPadre = ref(props.categoriasPadre);

const guardarCategoria = async () => {
    try {
        loaderGuardarCategoria.value = true;
        const response = await axios.post("/dashboard/categorias", categoria.value);
        toast.success(response.data.mensaje);
        window.location.href = "/dashboard/categorias";
    } catch (error) {
        toast.error(error.response?.data?.message || "Error en el servidor");
    } finally {
        loaderGuardarCategoria.value = false;
    }
}

onMounted(async () => {

});
</script>

<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                <div class="breadcrumb-wrapper breadcrumb-contacts">
                    <div>
                        <h1>NUEVA CATEGORIA</h1>
                        <p class="breadcrumbs">
                            <span>
                            <a href="/dashboard/inicio">Inicio</a>
                        </span>
                            <span><i class="mdi mdi-chevron-right"></i></span>
                            <a href="/dashboard/categorias">Categorias</a>

                            <span><i class="mdi mdi-chevron-right"></i></span>Nueva Categoria
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <form @submit.prevent="guardarCategoria">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between mb-4">
                    <a href="/dashboard/categorias" class="btn btn-outline-danger">CANCELAR</a>
                    <button :disabled="loaderGuardarCategoria" type="submit" class="btn btn-success"> GUARDAR</button>
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
