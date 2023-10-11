<template>
    <label class="block text-gray-700 uppercase tracking-wide text-xs font-bold mb-2">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>

<script setup>
defineProps(['value']);
</script>
