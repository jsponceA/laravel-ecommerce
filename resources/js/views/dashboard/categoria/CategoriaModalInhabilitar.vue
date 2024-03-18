<script setup>
import {onMounted, ref, watch} from "vue";
import {toast} from "vue3-toastify";

const modalInstance = ref(null);
const refModalInhabilitarCategoria = ref(null);
const loaderInhabilitarCategoria = ref(false);

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

const inhabilitarCategoria = async () => {
    try {
        loaderInhabilitarCategoria.value = true;
        const reponse = await axios.post(`/dashboard/categorias/inhabilitar/${props.id}`);
        await emit("cerrarModal");
        toast.success(reponse.data.mensaje);
        await emit("listarCategorias");
    }catch (error) {
        toast.error(error.response?.data?.message || "Error en el servidor");
    } finally {
        loaderInhabilitarCategoria.value = false;
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
    if (refModalInhabilitarCategoria.value) {
        modalInstance.value = bootstrap.Modal.getOrCreateInstance(
            refModalInhabilitarCategoria.value
        );
        refModalInhabilitarCategoria.value.addEventListener(
            "hidden.bs.modal",
            cerrarModalEvent
        );
    }
});
</script>

<template>
    <div
        class="modal fade"
        ref="refModalInhabilitarCategoria"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning bg-gradient text-white">
                    <h1 class="modal-title fs-6">CONFIRMACIÓN PARA DAR DE BAJA</h1>
                    <button
                        @click="$emit('cerrarModal')"
                        type="button"
                        class="btn-close"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <p class="my-0">
                        ¿Esta seguro que desea <b>dar de baja</b> esta categoria?
                    </p>

                </div>
                <div class="modal-footer justify-content-between">
                    <button :disabled="loaderInhabilitarCategoria"  @click="$emit('cerrarModal')" type="button" class="btn btn-outline-danger">CANCELAR</button>
                    <button  :disabled="loaderInhabilitarCategoria" @click="inhabilitarCategoria" type="button" class="btn btn-success">CONFIRMAR</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
