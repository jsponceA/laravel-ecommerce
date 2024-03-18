<script setup>
import {onMounted, ref} from "vue";
import dayjs from "@/plugins/dayjs.js";
import CategoriaModalEliminar from "@/views/dashboard/categoria/CategoriaModalEliminar.vue";
import CategoriaModalHabilitar from "@/views/dashboard/categoria/CategoriaModalHabilitar.vue";
import CategoriaModalInhabilitar from "@/views/dashboard/categoria/CategoriaModalInhabilitar.vue";

const filtrosCategoriaInit = {
    registrosPorPagina:15,
    paginaActual:1,
    buscar:""
};
const categoriasData = ref({});
const filtrosCategorias = ref({...filtrosCategoriaInit});
const ojbModalEliminar = ref({
    id:"",
    isOpen:false
});
const ojbModalHabilitar = ref({
    id:"",
    isOpen:false
});
const ojbModalInhabilitar = ref({
    id:"",
    isOpen:false
});

const listarCategorias = async (paginaActual = 1) => {
    try {
        filtrosCategorias.value.paginaActual = paginaActual;
        const response = await axios.get("/dashboard/categorias/listado",{
            params:{
                registrosPorPagina:filtrosCategorias.value.registrosPorPagina,
                paginaActual:filtrosCategorias.value.paginaActual,
                buscar:filtrosCategorias.value.buscar,
            }
        });
        categoriasData.value = response.data.categorias;
    } catch (error) {
        console.log(error);
    } finally {

    }
}

const limpiarfiltrosCategorias = async () => {
    filtrosCategorias.value = {...filtrosCategoriaInit};
    await listarCategorias();
}

onMounted(async () => {
    await listarCategorias();
});
</script>

<template>
    <CategoriaModalEliminar :isOpen="ojbModalEliminar.isOpen"
                            :id="ojbModalEliminar.id"
                            @cerrarModal="ojbModalEliminar.isOpen = false"
                            @listarCategorias="listarCategorias"/>

    <CategoriaModalHabilitar :isOpen="ojbModalHabilitar.isOpen"
                            :id="ojbModalHabilitar.id"
                            @cerrarModal="ojbModalHabilitar.isOpen = false"
                            @listarCategorias="listarCategorias"/>

    <CategoriaModalInhabilitar :isOpen="ojbModalInhabilitar.isOpen"
                             :id="ojbModalInhabilitar.id"
                             @cerrarModal="ojbModalInhabilitar.isOpen = false"
                             @listarCategorias="listarCategorias"/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                <div class="breadcrumb-wrapper breadcrumb-contacts">
                    <div>
                        <h1>LISTADO DE CATEGORIAS</h1>
                        <p class="breadcrumbs"><span><a href="/dashboard/inicio">Inicio</a></span>
                            <span><i class="mdi mdi-chevron-right"></i></span>Categorias
                        </p>
                    </div>
                    <div>
                        <a href="/dashboard/categorias/create" class="btn btn-primary"> NUEVA CATEGORIA
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text"><i class="mdi mdi-database-search mdi-18px"></i></span>
                    <input @keyup.enter="listarCategorias()" v-model="filtrosCategorias.buscar" type="text" class="form-control" placeholder="Escriba para buscar...">
                </div>
            </div>
            <div class="col-md-4">
                <button @click="listarCategorias()" type="button" class="btn btn-info mx-1">FILTRAR</button>
                <button @click="limpiarfiltrosCategorias" type="button" class="btn btn-outline-danger mx-1">LIMPIAR</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ACCIONES</th>
                            <th>PADRE</th>
                            <th>NOMBRE</th>
                            <th>ESTADO</th>
                            <th>FECHA CREACIÓN</th>
                            <th>FECHA MODIFICACIÓN</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="categoriasData.data" v-for="categoria in categoriasData.data" :key="categoria.id">
                            <td>
                                <div class="btn-group mb-1">
                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle rounded-1"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">Acciones</button>

                                    <div class="dropdown-menu" style="">
                                        <a :href="`/dashboard/categorias/${categoria.id}/edit`" class="dropdown-item"><i class="mdi mdi-pencil"></i> Editar</a>
                                        <button v-if="!categoria.estado" @click="ojbModalHabilitar = {
                                            id:categoria.id,
                                            isOpen:true
                                        }"  type="button" class="dropdown-item"><i class="mdi mdi-arrow-up"></i> Habilitar</button>
                                        <button v-else @click="ojbModalInhabilitar = {
                                            id:categoria.id,
                                            isOpen:true
                                        }" type="button" class="dropdown-item"><i class="mdi mdi-arrow-down"></i> Dar Baja</button>
                                        <button @click="ojbModalEliminar = {
                                            id:categoria.id,
                                            isOpen:true
                                        }" type="button" class="dropdown-item"><i class="mdi mdi-trash-can"></i> Eliminar</button>
                                    </div>
                                </div>
                            </td>
                            <td>{{ categoria.padre?.nombre }}</td>
                            <td>{{ categoria.nombre }}</td>
                            <td>
                                <span v-if="categoria.estado" class="badge badge-success text-capitalize">Habilitado</span>
                                <span v-else class="badge badge-danger text-capitalize">Inhabilitado</span>
                            </td>
                            <td>{{ dayjs(categoria.created_at).format("DD/MM/YYYY hh:mm A") }}</td>
                            <td>{{ dayjs(categoria.updated_at).format("DD/MM/YYYY hh:mm A") }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center">
                        <p>Mostrando {{categoriasData.from}} to {{categoriasData.to}} de {{ categoriasData.total }} registros</p>
                        <Bootstrap5Pagination @paginationChangePage="listarCategorias" size="small" :limit="3" :data="categoriasData"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
