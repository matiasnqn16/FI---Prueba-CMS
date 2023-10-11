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
import { nextTick , ref } from 'vue';
import Swal from 'sweetalert2';


const nameInput = ref(null);
const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');


const props = defineProps({
    categorias: {type:Object}
});

const form = useForm({
    nombre:'',
});

const openModal = (op, category) =>{
    modal.value = true;
    operation.value = op;
    if(op == 1){
        title.value = 'Nueva Categoria';
        nextTick(() => nameInput.value.focus());
    }
    else{
        title.value = 'Editar Categoria '+category.nombre;
        form.nombre = category.nombre;
        id.value = category.id;
    }
};


const save = () =>{
    if(operation.value == 1){
        form.post(route('categorias.store'),{
            onSuccess: () => {ok('Categoria creada')}
        });
    }
    else{
        form.put(route('categorias.update',id.value),{
            onSuccess: () => {ok('Categoria editada')}
        });
    }
}

const closeModal = () => {
    modal.value = false;
    form.reset();
}

const ok = (msj) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msj,icon:'success'});
}

 
const borrarCategoria = (id,nombre) =>{
    const alerta = Swal.mixin({
        buttonsStyling:true
    })
    alerta.fire({
        title:'Enserio quiere eliminar la categoria ' + nombre + '?',
        icon:'question', showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> si, borralo',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> no'
    }).then((result) => {
        if(result.isConfirmed) {
            form.delete(route('clientes.destroy',id),{
                onSuccess: () =>{ok('Cliente Eliminado')}
            });
        }
    }); 
}

</script>

<template>
    <Head title="Clientes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clientes WOW!</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <PrimaryButton @click="$event => openModal(1)">
                        <i class="fa-solid fa-plus-circle"></i> Añadir
                    </PrimaryButton>
                </div>
            </div>

            <div class="bg-white grid v-screen place-items-center overflow-x-auto">
                <table class="table-auto border border-gray-400" >
                    <thead>
                        <tr class="bg-gray-100">
                            <th data-priority="4" class="px-2 py-4">#</th>
                            <th data-priority="2" class="px-4 py-4">Nombre</th>
                            <th data-priority="1" class="px-4 py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="category, i in categorias" :key="category.id">
                            <td class="border border-gray-400 px-2 py-4">{{ (category.id) }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ (category.nombre) }}</td>
                            <td class="border border-gray-400 px-4 py-4">

                                <WarningButton @click="$event => openModal(2,category)">
                                    <i class="fa-solid fa-edit"></i>
                                </WarningButton>

                                <DangerButton @click="$event => borrarCategoria(category.id,category.nombre)">
                                    <i class="fa-solid fa-trash"></i>
                                </DangerButton>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Modal :show="modal" @close="closeModal">
                    <h2 class="p-3 text-lg font.medium text-hray-900">{{ title }}</h2>
                <div class="p-3 mt-1">
                    <InputLabel for="nombre" value="Nombre:"></InputLabel>
                    <TextInput id="nombre" ref="nameInput" v-model="form.nombre" type="text" class="mt-1 block w-3/4" placeholder="Nombre" ></TextInput>
                    <InputError :message="form.errors.nombre" class="mt-2"></InputError>
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
