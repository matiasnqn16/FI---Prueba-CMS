<template>
    <header class="flex items-center justify-between border-b-4 border-indigo-600 bg-white px-6 py-4">
        <div class="flex items-center">
            <button @click="$page.props.showingMobileMenu = !$page.props.showingMobileMenu"
                class="text-gray-500 focus:outline-none lg:hidden">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <HoraActual>
        </HoraActual>

        <div class="flex items-center">
            <dropdown>


                <template #trigger>
                    <div class="p-1 border rounded-lg border-gray-600 hover:bg-indigo-600 hover:text-white transition flex">
                        <div class="h6 w6 mx-1 border border-gray-500 rounded">
                            <i class="mx-1 fa-regular fa-user"></i>
                        </div>
                        <button @click="dropdownOpen = !dropdownOpen" class="relative block overflow-hidden">
                            {{ $page.props.auth.user.name }}
                        </button>
                        <div class="h6 w6 mx-3">
                            <i class="fa-solid fa-caret-down"></i>
                        </div>

                    </div>
                </template>

                <template #content>
                    <dropdown-link :href="route('profile.edit')">
                        Profile
                    </dropdown-link>

                    <dropdown-link class="w-full text-left" :href="route('logout')" method="post" as="button">
                        Log out
                    </dropdown-link>
                </template>
            </dropdown>
        </div>
    </header>
</template>

<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import HoraActual from '@/Components/HoraActual.vue';
</script>
