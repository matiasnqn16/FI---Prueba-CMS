<template>
    <div v-show="message">
        <p class="text-red-500 text-sm italic">
            {{ message }}
        </p>
    </div>
</template>

<script setup>
defineProps(['message']);
</script>
