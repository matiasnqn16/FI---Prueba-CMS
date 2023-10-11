<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';
import Swal from 'sweetalert2';

import SelectCheckbox from '@/Components/SelectCheckbox.vue';


const nameInput = ref(null);
const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');


const props = defineProps({
    productos: { type: Object }
});

const form = useForm({
    plu: '',
    barcode: '',
    descripcion_producto: '',
    precio_venta_producto: '',
    precio_compra_producto: '',
    precio_reparto_producto: '',
    estado_producto: '',
    imagen_producto: '',
    existencia: ''
});

const openModal = (op, product) => {
    modal.value = true;
    operation.value = op;
    if (op == 1) {
        title.value = 'Nuevo producto';
        nextTick(() => nameInput.value.focus());
    }
    else {
        title.value = 'Editar producto ' + product.descripcion_producto;
        form.plu = product.plu;
        form.barcode = product.barcode;
        form.descripcion_producto = product.descripcion_producto;
        form.precio_venta_producto = product.precio_venta_producto;
        form.precio_compra_producto = product.precio_compra_producto;
        form.precio_reparto_producto = product.precio_reparto_producto;
        form.estado_producto = product.estado_producto;
        form.imagen_producto = product.imagen_producto;
        form.existencia = product.existencia;
        id.value = product.id;
    }
};


const save = () => {
    if (operation.value == 1) {
        form.post(route('productos.store'), {
            onSuccess: () => { ok('Producto creado') }
        });
    }
    else {
        form.put(route('productos.update', id.value), {
            onSuccess: () => { ok('Producto editado') }
        });
    }
}

const closeModal = () => {
    modal.value = false;
    form.reset();
}

const ok = (msj) => {
    form.reset();
    closeModal();
    Swal.fire({ title: msj, icon: 'success' });
}



const borrarProducto = (id, nombre) => {
    const alerta = Swal.mixin({
        buttonsStyling: true
    })
    alerta.fire({
        title: 'Enserio quiere eliminar el producto ' + nombre + '?',
        icon: 'question', showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> si, borralo',
        cancelButtonText: '<i class="fa-solid fa-ban"></i> no'
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('productos.destroy', id), {
                onSuccess: () => { ok('Producto Eliminado') }
            });
        }
    });
}

</script>

<template>
    <Head title="Productos" />

    <AuthenticatedLayout>
        <template #header>
            Lista de productos
        </template>


        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 ">
                    <PrimaryButton @click="$event => openModal(1)">
                        <i class="fa-solid fa-plus-circle"></i> Añadir
                    </PrimaryButton>
                </div>
            </div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            #</th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            codigo de barras</th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            descripcion producto</th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            existencia</th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 w-32">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product, i in productos" :key="product.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <div class="h-16 w-16">
                                <img v-if="product.imagen_producto" :src="product.imagen_producto" alt="Imagen del producto" class="w-full h-full object-cover rounded">
                                <p v-else>No hay imagen disponible</p>
                            </div>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ product.barcode }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ product.descripcion_producto }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ product.existencia }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white text-sm">

                            <WarningButton @click="$event => openModal(2, product)" class="mr-3 mb-2">
                                <i class="fa-solid fa-edit"></i>
                            </WarningButton>

                            <DangerButton @click="$event => borrarProducto(product.id, product.descripcion_producto)">
                                <i class="fa-solid fa-trash"></i>
                            </DangerButton>

                        </td>
                    </tr>
                </tbody>
            </table>

            <Modal :show="modal" @close="closeModal">
                <h2 class="p-3 text-lg font.medium font-bold text-hray-900">{{ title }}</h2>
                <div class="bg-white shadow-md rounded px-7 pt-2 pb-8 mb-4 flex flex-col">

                    <div class="-mx-3 md:flex mb-6">

                        <div class="md:w-full px-3 mb-6 md:mb-0">
                            <InputLabel for="descripcion_producto" value="Descripcion Producto:"></InputLabel>
                            <TextInput id="descripcion_producto" v-model="form.descripcion_producto" type="descripcion_producto"
                                class="mt-1 block w-3/4" placeholder="descripcion_producto"
                                >
                            </TextInput>
                            <InputError :message="form.errors.descripcion_producto" class="mt-2"></InputError>
                        </div>

                    </div>


                    <div class="-mx-3 md:flex mb-6">
            
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <InputLabel for="barcode" value="Codigo de barras:"></InputLabel>
                            <TextInput id="barcode" ref="nameInput" v-model="form.barcode" type="number" class="mt-1 block w-3/4"
                                placeholder="barcode"></TextInput>
                            <InputError :message="form.errors.barcode" class="mt-2"></InputError>
                        </div>
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <InputLabel for="plu" value="Codigo PLU:"></InputLabel>
                            <TextInput id="plu" v-model="form.plu" type="number" class="mt-1 block w-3/4" placeholder="plu">
                            </TextInput>
                            <InputError :message="form.errors.plu" class="mt-2"></InputError>
                        </div>

                    </div>

                    <div class="-mx-3 md:flex mb-6">

                        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                            <InputLabel for="precio_compra_producto" value="Precio Compra:"></InputLabel>
                            <TextInput id="precio_compra_producto" v-model="form.precio_compra_producto" type="number"
                                class="mt-1 block w-3/4" placeholder="precio_compra_producto"></TextInput>
                            <InputError :message="form.errors.precio_compra_producto" class="mt-2"></InputError>
                        </div>
                        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                            <InputLabel for="precio_venta_producto" value="Precio Venta:"></InputLabel>
                            <TextInput id="precio_venta_producto" v-model="form.precio_venta_producto" type="number"
                                class="mt-1 block w-3/4" placeholder="precio_venta_producto"></TextInput>
                            <InputError :message="form.errors.precio_venta_producto" class="mt-2"></InputError>
                        </div>
                        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                            <InputLabel for="precio_reparto_producto" value="Precio Reparto:"></InputLabel>
                            <TextInput id="precio_reparto_producto" v-model="form.precio_reparto_producto" type="number"
                                class="mt-1 block w-3/4" placeholder="precio_reparto_producto"></TextInput>
                            <InputError :message="form.errors.precio_reparto_producto" class="mt-2"></InputError>
                        </div>
                        <div class="md:w-1/4 px-3 mb-6 md:mb-0">
                        <InputLabel for="existencia" value="existencia:"></InputLabel>
                        <TextInput id="existencia" v-model="form.existencia" type="number" class="mt-1 block w-3/4"
                            placeholder="existencia"></TextInput>
                        <InputError :message="form.errors.existencia" class="mt-2"></InputError>
                        </div>

                    </div>

                    <div class="-mx-3 md:flex mb-6">

                        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                            <InputLabel for="estado_producto" value="Habilitar Producto:"></InputLabel>

                            <SelectCheckbox id="estado_producto" name="estado_producto" label="Hablitar" v-model="form.estado_producto"/>

                            <InputError :message="form.errors.estado_producto" class="mt-2"></InputError>
                        </div>


                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <InputLabel for="imagen_producto" value="imagen_producto:"></InputLabel>
                                <input type="file" @input="form.imagen_producto = $event.target.files [0]"/>
                                <InputError :message="form.errors.imagen_producto" class="mt-2"></InputError>
                                <div>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <img v-if="form.imagen_producto" :src="form.imagen_producto" alt="Imagen del producto" class="w-40 h-40 object-cover rounded">
                                        <p v-else>No hay imagen disponible</p>
                                    </td>
                                </div>
            
                        </div>
                        
                    </div>

                </div>
                <div class="p-3 mt-1">
                    <div class="flex">
                        <PrimaryButton :disabled="form.processing" @click="save">
                            <i class="fa-solid fa-save m-2"> Guardar</i>
                        </PrimaryButton>
                        <SecondaryButton class="ml-3" :disabled="form.processing" @click="closeModal">
                            <i class="fa-solid fa-cancel m-2"> Cancelar</i>
                        </SecondaryButton>
                    </div>
                </div>
            </Modal>
        </div>
    </AuthenticatedLayout>
</template>
