<script setup>
import {onMounted, ref, watch} from "vue";
import {toast} from "vue3-toastify";

const modalInstance = ref(null);
const refModalEliminarCategoria = ref(null);
const loaderEliminarCategoria = ref(false);

const props = defineProps({
   isOpen:{
       type:Boolean,
       default:false
   },
   id:{
       type:[Number,String],
       required:true
   }
});
const emit = defineEmits(["cerrarModal","listarCategorias"]);

const eliminarCategoria = async () => {
    try {
        loaderEliminarCategoria.value = true;
        await axios.delete(`/dashboard/categorias/${props.id}`);
        await emit("cerrarModal");
        toast.success("Categoria eliminada satisfactoriamente")
        await emit("listarCategorias");
    }catch (error) {
        toast.error(error.response?.data?.message || "Error en el servidor");
    } finally {
        loaderEliminarCategoria.value = false;
    }
}

const cerrarModalEvent = () => emit("cerrarModal");

watch(
    () => props.isOpen,
    (newValue) => {
        if (modalInstance.value) {
            newValue ? modalInstance.value.show() : modalInstance.value.hide();
        }
    }
);

onMounted(async () => {
    if (refModalEliminarCategoria.value) {
        modalInstance.value = bootstrap.Modal.getOrCreateInstance(
            refModalEliminarCategoria.value
        );
        refModalEliminarCategoria.value.addEventListener(
            "hidden.bs.modal",
            cerrarModalEvent
        );
    }
});
</script>

<template>
    <div
        class="modal fade"
        ref="refModalEliminarCategoria"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger bg-gradient text-white">
                    <h1 class="modal-title fs-6">CONFIRMACIÓN PARA ELIMINAR</h1>
                    <button
                        @click="$emit('cerrarModal')"
                        type="button"
                        class="btn-close"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <p class="my-0">
                        ¿Esta seguro que desea <b>eliminar</b> esta categoria?. Realizada
                        esta acción no se podra revertir
                    </p>
                    <p class="text-primary mt-1 mb-0 fw-medium">
                        *Se recomienda "dar de baja" la categoria si desea que ya no se
                        muestre.
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button :disabled="loaderEliminarCategoria"  @click="$emit('cerrarModal')" type="button" class="btn btn-outline-danger">CANCELAR</button>
                    <button  :disabled="loaderEliminarCategoria" @click="eliminarCategoria" type="button" class="btn btn-success">CONFIRMAR</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
