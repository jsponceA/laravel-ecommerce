<script setup>
import {onMounted, ref, watch} from "vue";
import {toast} from "vue3-toastify";

const modalInstance = ref(null);
const refModalHabilitarCategoria = ref(null);
const loaderHabilitarCategoria = ref(false);

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

const habilitarCategoria = async () => {
    try {
        loaderHabilitarCategoria.value = true;
        const reponse = await axios.post(`/dashboard/categorias/habilitar/${props.id}`);
        await emit("cerrarModal");
        toast.success(reponse.data.mensaje);
        await emit("listarCategorias");
    }catch (error) {
        toast.error(error.response?.data?.message || "Error en el servidor");
    } finally {
        loaderHabilitarCategoria.value = false;
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
    if (refModalHabilitarCategoria.value) {
        modalInstance.value = bootstrap.Modal.getOrCreateInstance(
            refModalHabilitarCategoria.value
        );
        refModalHabilitarCategoria.value.addEventListener(
            "hidden.bs.modal",
            cerrarModalEvent
        );
    }
});
</script>

<template>
    <div
        class="modal fade"
        ref="refModalHabilitarCategoria"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success bg-gradient text-white">
                    <h1 class="modal-title fs-6">CONFIRMACIÓN PARA HABILITAR</h1>
                    <button
                        @click="$emit('cerrarModal')"
                        type="button"
                        class="btn-close"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <p class="my-0">
                        ¿Esta seguro que desea <b>habilitar</b> esta categoria?
                    </p>

                </div>
                <div class="modal-footer justify-content-between">
                    <button :disabled="loaderHabilitarCategoria"  @click="$emit('cerrarModal')" type="button" class="btn btn-outline-danger">CANCELAR</button>
                    <button  :disabled="loaderHabilitarCategoria" @click="habilitarCategoria" type="button" class="btn btn-success">CONFIRMAR</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
