<template>
    <div>
        <label v-bind:for="uuid"
               v-text="label"
               class="lnfb-block lnfb-mb-2 lnfb-text-sm lnfb-font-medium lnfb-text-gray-900 dark:lnfb-text-white"/>

        <select :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                v-bind:id="uuid"
                class="lnfb-bg-gray-50 lnfb-border lnfb-border-gray-300 lnfb-text-gray-900 lnfb-text-sm lnfb-rounded-lg focus:lnfb-ring-blue-500 focus:lnfb-border-blue-500 lnfb-block lnfb-w-full lnfb-p-2.5 dark:lnfb-bg-gray-700 dark:lnfb-border-gray-600 dark:lnfb-placeholder-gray-400 dark:lnfb-text-white dark:focus:lnfb-ring-blue-500 dark:focus:lnfb-border-blue-500"
        >
            <option v-for="option in options"
                    :value="option.value"
            >
                {{ option.name }}
            </option>
        </select>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { v4 as uuidv4 } from 'uuid';

defineProps({
    modelValue: {
        required: true,
    },
    label: {
        required: true,
    },
    options: {
        type: Array,
        required: true,
    }
})

defineEmits(['update:modelValue'])

const uuid = ref('')

onMounted(() => {
    uuid.value = uuidv4()
})
</script>
