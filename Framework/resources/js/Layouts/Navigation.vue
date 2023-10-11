<template>
    <div :class="$page.props.showingMobileMenu ? 'block' : 'hidden'" @click="$page.props.showingMobileMenu = false"
        class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"></div>

    <div :class="$page.props.showingMobileMenu ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
        class="overflow-y-auto fixed inset-y-0 left-0 z-30 w-64 bg-gray-600 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex justify-center items-center mt-5 py-4 bg-gray-400 rounded-xl mx-2">
            <div class="flex items-center">
                <ApplicationLogo class="w-16 h-16">

                </ApplicationLogo>

                <span class="mx-2 text-3xl font-extrabold text-white">BareluPOS</span>
            </div>
        </div>

        <nav class="mt-6" x-data="{ isMultiLevelMenuOpen: false }">
            <nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                <template #icon>
                    <i class="ml-1 fa-solid fa-gauge"></i>
                </template>
                Dashboard
            </nav-link>

            <nav-link :href="route('clientes.index')" :active="route().current('clientes.index')">
                <template #icon>
                    <i class="ml-1 fa-solid fa-book"></i>
                </template>
                Clientes
            </nav-link>

            <nav-link :href="route('productos.index')" :active="route().current('productos.index')">
                <template #icon>
                    <i class="ml-1 fa-solid fa-pen"></i>
                </template>
                Productos
            </nav-link>

            <nav-link :href="route('categorias.index')" :active="route().current('categorias.index')">
                <template #icon>
                    <i class="ml-1 fa-solid fa-pen"></i>
                </template>
                Categorias
            </nav-link>

            <nav-link :href="route('proveedores')" :active="route().current('proveedores')" class="bg-gray-800">
                <template #icon>
                    <i class="ml-1 fa-solid fa-book"></i>
                </template>
                Proveedores
            </nav-link>

            <nav-link :href="route('ventas')" :active="route().current('ventas')" class="bg-gray-800">
                <template #icon>
                    <i class="ml-1 fa-solid fa-chain"></i>
                </template>
                Ventas
            </nav-link>

            <nav-link :href="route('despachos')" :active="route().current('despachos')" class="bg-gray-800">
                <template #icon>
                    <i class="ml-1 fa-solid fa-key"></i>
                </template>
                Despachos
            </nav-link>

            <nav-link :href="route('users.index')" :active="route().current('users.index')">
                <template #icon>
                    <i class="ml-1 fa-solid fa-users"></i>
                </template>
                Usuarios
            </nav-link>

            <nav-link :href="route('about')" :active="route().current('about')">
                <template #icon>
                    <i class="ml-1 fa-solid fa-add"></i>
                </template>
                About us
            </nav-link>

            <a class="flex items-center mt-4 py-2 px-6 text-gray-100" href="#"
                @click="showingTwoLevelMenu = !showingTwoLevelMenu">
                <i class="ml-1 fa-solid fa-add"></i>
                <span class="mx-3">Two-level menu</span>
            </a>
            <transition enter-to-class="transition-all duration-300 ease-in-out" enter-from-class="max-h-0 opacity-25"
                leave-from-class="opacity-100 max-h-xl" leave-to-class="max-h-0 opacity-0">
                <div v-show="showingTwoLevelMenu">
                    <ul class="overflow-hidden p-2 mx-4 mt-2 space-y-2 text-sm font-medium text-white bg-gray-700 bg-opacity-50 rounded-md shadow-inner"
                        aria-label="submenu">
                        <li>
                            <nav-link :href="route('productos.index')" :active="route().current('productos.index')">
                                <template #icon>
                                    <i class="ml-1 fa-solid fa-pen"></i>
                                </template>
                                Productos
                            </nav-link>
                        </li>
                        <li>

                            <nav-link :href="route('categorias.index')" :active="route().current('categorias.index')">
                                <template #icon>
                                    <i class="ml-1 fa-solid fa-pen"></i>
                                </template>
                                Categorias
                            </nav-link>

                        </li>
                    </ul>
                </div>
            </transition>

        </nav>
    </div>
</template>

<script>
import NavLink from '@/Components/NavLink.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'

export default {
    components: {
        NavLink,
        Link,
        ApplicationLogo
    },

    setup() {
        let showingTwoLevelMenu = ref(false)

        return {
            showingTwoLevelMenu
        }
    },
    name: 'App',
}
</script>

<style scoped></style>
