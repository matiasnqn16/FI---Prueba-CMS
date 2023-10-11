<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head, useForm } from '@inertiajs/vue3';

import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { nextTick, ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import Swal from 'sweetalert2';

const props = defineProps({
    users: Object
})

const nameInput = ref(null);
const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');

const form = useForm({
    name: '',
    email: '',
    usuario: '',
    telefono: '',
    password: '',
    password_confirmation: '',
    terms: false,
    rol: ''
});

const openModal = (op, product) => {
    modal.value = true;
    operation.value = op;
    if (op == 1) {
        title.value = 'Nuevo producto';
        nextTick( () => nameInput.value.focus());
    }
    else {
        title.value = 'Editar usuario ' + product.descripcion_producto;
        form.name = user.name;
        form.email = user.email;
        form.usuario = user.usuario;
        form.telefono = user.telefono;
        form.password = user.password;
        form.rol = user.rol;
        id.value = user.id;
    }
};

const save = () => {
    if (operation.value == 1) {
        form.post(route('users.store'), {
            onSuccess: () => { ok('Usuario creado') }
        });
    }
    else {
        form.put(route('users.update', id.value), {
            onSuccess: () => { ok('Usuario editado') }
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

const borrarUsuario = (id, nombre) => {
    const alerta = Swal.mixin({
        buttonsStyling: true
    })
    alerta.fire({
        title: 'Enserio quiere eliminar el usuario de ' + nombre + '?',
        icon: 'question', showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> si, borralo',
        cancelButtonText: '<i class="fa-solid fa-ban"></i> no'
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('user.destroy', id), {
                onSuccess: () => { ok('Usuario eliminado!') }
            });
        }
    });
}

</script>

<script>

/* Defino metodos para usar dentro de las llaves */
export default {
  methods: {
    getRolName(rol) {
      switch (rol) {
        case 1:
          return "Admin";
        case 2:
          return "Cajero";
        case 3:
          return "Despachador";
        case 4:
          return "Repartidor";
        default:
          return "Desconocido";
      }
    },
  },
};
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            Usuarios
        </template>

        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 ">
                    <PrimaryButton @click="$event => openModal(1)">
                        <i class="fa-solid fa-plus-circle"></i> Añadir Nuevo Usuario
                    </PrimaryButton>
                </div>
            </div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nombre
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Rol
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Usuario
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Email
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Telefono
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 w-20">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users.data" :key="user.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white px-5 py-2 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.name }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-2 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ getRolName(user.rol) }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-2 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.usuario }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-2 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.email }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-2 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.telefono }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white">

                            <WarningButton @click="$event => openModal(2, user)" class="mr-3 mb-2">
                                <i class="fa-solid fa-edit"></i>
                            </WarningButton>

                            <DangerButton @click="$event => borrarUsuario(user.id, user.usuario)">
                                <i class="fa-solid fa-trash"></i>
                            </DangerButton>

                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="users.links" />
            </div>
        </div>

        <Modal :show="modal" @close="closeModal">
            <h2 class="p-3 text-lg font.medium text-hray-900">{{ title }}</h2>
            <div class="p-3 mt-1">
                <InputLabel for="usuario" value="usuario:"></InputLabel>
                <TextInput id="usuario" v-model="form.usuario" type="text" class="mt-1 block w-3/4"
                    placeholder="usuario" ref="nameInput"></TextInput>
                <InputError :message="form.errors.usuario" class="mt-2"></InputError>
            </div>
            <div class="p-3 mt-1">
                <InputLabel for="name" value="Nombre y Apellido:"></InputLabel>
                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-3/4" placeholder="name">
                </TextInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
            </div>
            <div class="p-3 mt-1">
                <InputLabel for="email" value="email:"></InputLabel>
                <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-3/4" placeholder="email">
                </TextInput>
                <InputError :message="form.errors.email" class="mt-2"></InputError>
            </div>
            <div class="p-3 mt-1">
                <InputLabel for="telefono" value="telefono:"></InputLabel>
                <TextInput id="telefono" v-model="form.telefono" type="number" class="mt-1 block w-3/4"
                    placeholder="telefono"></TextInput>
                <InputError :message="form.errors.telefono" class="mt-2"></InputError>
            </div>
            <div class="p-3 mt-1">
                <InputLabel for="password" value="password:"></InputLabel>
                <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-3/4"
                    placeholder="password"></TextInput>
                <InputError :message="form.errors.password" class="mt-2"></InputError>
            </div>
            <div class="p-3 mt-1">
                <InputLabel for="password_confirmation" value="Confirmar Password" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="p-3 mt-1">
                <InputLabel for="rol" value="rol:"></InputLabel>
                <TextInput id="rol" v-model="form.rol" type="number" class="mt-1 block w-3/4" placeholder="rol"></TextInput>
                <InputError :message="form.errors.rol" class="mt-2"></InputError>
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


    </AuthenticatedLayout>
</template>


