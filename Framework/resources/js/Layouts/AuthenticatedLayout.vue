<template>
    <div class="flex h-screen bg-gray-200 font-roboto">
        <Navigation />

        <div class="flex flex-1 flex-col overflow-hidden">
            <Header />

            <main class="flex-1 overflow-y-auto overflow-x-hidden bg-gradient">
                <div class="container mx-auto px-6 py-8">
                    <h3 class="mb-4 text-3xl font-medium text-gray-700">
                        <slot name="header" />
                    </h3>

                    <slot />

                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import Header from '@/Layouts/Header.vue';
import Navigation from '@/Layouts/Navigation.vue';
</script>

<style>
.bg-gradient {
    background-image: linear-gradient(to left bottom, #59a1f0, #6bb1f0, #82c0ef, #9cceee, #b8dbee, #aee4f7, #a3ecfd, #98f5ff, #48fcf5, #00ffd7, #00ffa6, #0fff62);
}

</style>