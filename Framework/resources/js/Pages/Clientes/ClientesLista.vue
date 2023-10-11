<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
//import SelectInput from '@/Components/SelectInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';
import Swal from 'sweetalert2';

const nameInput = ref(null);
const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');


const props = defineProps({
    clientes: Object
});

const form = useForm({
    nombre: '',
    apellido: '',
    telefono: '',
    email: '',
    provincia: '',
    direccion: ''
});

const openModal = (op, client) => {
    modal.value = true;
    operation.value = op;
    if (op == 1) {
        title.value = 'Nuevo cliente';
        nextTick(() => nameInput.value.focus());
    }
    else {
        title.value = 'Editar cliente ' + client.nombre + " " + client.apellido;
        form.nombre = client.nombre;
        form.apellido = client.apellido;
        form.email = client.email;
        form.telefono = client.telefono;
        form.direccion = client.direccion;
        form.provincia = client.provincia;
        id.value = client.id;
    }
};


const save = () => {
    if (operation.value == 1) {
        form.post(route('clientes.store'), {
            onSuccess: () => { ok('Cliente creado') }
        });
    }
    else {
        form.put(route('clientes.update', id.value), {
            onSuccess: () => { ok('Cliente editado') }
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



const borrarCliente = (id, nombre) => {
    const alerta = Swal.mixin({
        buttonsStyling: true
    })
    alerta.fire({
        title: 'Enserio quiere eliminar a ' + nombre + '?',
        icon: 'question', showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> si, borralo',
        cancelButtonText: '<i class="fa-solid fa-ban"></i> no'
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('clientes.destroy', id), {
                onSuccess: () => { ok('Cliente Eliminado') }
            });
        }
    });
}

</script>

<template>
    <Head title="Clientes" />

    <AuthenticatedLayout>
        <template #header>
            Lista de clientes
        </template>

        <div>
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <PrimaryButton @click="$event => openModal(1)">
                        <i class="fa-solid fa-plus-circle"></i> Añadir
                    </PrimaryButton>
                </div>
            </div>

            <div class="bg-white grid v-screen place-items-center overflow-x-auto">
                <table class="w-full table-fixed">
                    <thead>
                        <tr
                            class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            
                            <th
                                class="border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Nombre y Apellido</th>
                            <th
                                class="hidden sm:hidden xl:table-cell border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                email</th>
                            <th
                                class="border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Telefono</th>
                            <th
                                class="hidden sm:hidden md:table-cell border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Provincia</th>
                            <th
                                class="hidden sm:hidden md:table-cell border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Dirección</th>
                            <th
                                class="border-b-2 border-gray-200 bg-gray-100 px-3 py-3 tracking-wider text-gray-600 md:w-32 w-1/4">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="client, i in clientes" :key="client.id">
                            
                            <td class="border-b border-gray-200 bg-white px-4 py-3 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap font-medium"> {{ (client.nombre) + " " + (client.apellido) }} </p>
                            </td>
                            <td class="hidden sm:hidden xl:table-cell border-b border-gray-200 bg-white px-4 py-3  text-sm">
                                <p class="text-gray-900 whitespace-no-wrap font-medium"> {{ (client.email) }} </p>
                            </td>
                            <td class="border-b border-gray-200 bg-white px-4 py-3 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap font-medium"> {{ (client.telefono) }} </p>
                            </td>
                            <td class="hidden sm:hidden md:table-cell border-b border-gray-200 bg-white px-4 py-3  text-sm">
                                <p class="text-gray-900 whitespace-no-wrap font-medium"> {{ (client.provincia) }} </p>
                            </td>
                            <td class="hidden sm:hidden md:table-cell border-b border-gray-200 bg-white px-4 py-3  text-sm">
                                <p class="text-gray-900 whitespace-no-wrap font-medium"> {{ (client.direccion) }} </p>
                            </td>
                            <td class="border-b border-gray-200 bg-white md:justify-start justify-items-end ">

                                <WarningButton @click="$event => openModal(2, client)" class="mr-3">
                                    <i class="fa-solid fa-edit"></i>
                                </WarningButton>

                                <DangerButton @click="$event => borrarCliente(client.id, client.nombre)" >
                                    <i class="fa-solid fa-trash"></i>
                                </DangerButton>

                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
            <Modal :show="modal" @close="closeModal">
                <h2 class="p-3 text-lg font.medium text-hray-900">{{ title }}</h2>
                <div class="bg-white shadow-md rounded px-7 pt-2 pb-8 mb-4 flex flex-col">
                    
                    <div class="-mx-3 md:flex mb-6">

                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <InputLabel for="nombre" value="Nombre:"></InputLabel>
                            <TextInput id="nombre" ref="nameInput" v-model="form.nombre" type="text" class="mt-1 block w-3/4"
                                placeholder="Nombre"></TextInput>
                            <InputError :message="form.errors.nombre" class="mt-2"></InputError>
                        </div>
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <InputLabel for="apellido" value="Apellido:"></InputLabel>
                            <TextInput id="apellido" v-model="form.apellido" type="text" class="mt-1 block w-3/4"
                                placeholder="apellido"></TextInput>
                            <InputError :message="form.errors.apellido" class="mt-2"></InputError>
                        </div>

                    </div>

                    <div class="-mx-3 md:flex mb-6">

                        <div class="md:w-full px-3 mb-6 md:mb-0">
                            <InputLabel for="email" value="Email:"></InputLabel>
                            <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-3/4" placeholder="email">
                            </TextInput>
                            <InputError :message="form.errors.email" class="mt-2"></InputError>
                        </div>
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <InputLabel for="telefono" value="telefono:"></InputLabel>
                            <TextInput id="telefono" v-model="form.telefono" type="number" class="mt-1 block w-3/4"
                                placeholder="telefono"></TextInput>
                            <InputError :message="form.errors.telefono" class="mt-2"></InputError>
                        </div>

                    </div>

                    <div class="-mx-3 md:flex">

                        <div class="p-3 mt-1">
                            <InputLabel for="provincia" value="provincia:"></InputLabel>
                            <TextInput id="provincia" v-model="form.provincia" type="text" class="mt-1 block w-3/4"
                                placeholder="provincia"></TextInput>
                            <InputError :message="form.errors.provincia" class="mt-2"></InputError>
                        </div>
                        <div class="p-3 mt-1">
                            <InputLabel for="direccion" value="direccion:"></InputLabel>
                            <TextInput id="direccion" v-model="form.direccion" type="text" class="mt-1 block w-3/4"
                                placeholder="direccion"></TextInput>
                            <InputError :message="form.errors.direccion" class="mt-2"></InputError>
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
