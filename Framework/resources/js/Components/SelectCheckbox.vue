<script>
export default {
    name: 'BaseCheckbox',
    inheritAttrs: false
}
</script>

<script setup>
const emit = defineEmits(['update:modelValue'])

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    modelValue: {
        type: Boolean,
        default: false
    }
})

const updateInput = ($event) => {
    emit('update:modelValue', $event.target.checked)
}
</script>

<template>
    <div class="flex flex-row mt-2">
        <input
            v-bind="$attrs"
            :checked="modelValue"
            @change="updateInput"
            type="checkbox"
            class="h-4 w-4 focus:ring-0 cursor-pointer rounded"
            true-value="1"
            false-value="0"
        />

        <label :for="$attrs.id" class="ml-2 block text-sm text-gray-900 cursor-pointer">
            {{label}}
        </label>
    </div>
</template>