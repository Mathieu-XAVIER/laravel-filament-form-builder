<template>
    <div>
        <label class="lnfb-relative lnfb-inline-flex lnfb-items-center lnfb-cursor-pointer">
            <input type="checkbox"
                   :value="modelValue"
                   @input="$emit('update:modelValue', $event.target.checked)"
                   class="lnfb-sr-only lnfb-peer" />
            <div class="lnfb-w-11 lnfb-h-6 lnfb-bg-gray-200 lnfb-rounded-full lnfb-peer peer-focus:lnfb-ring-4 peer-focus:lnfb-ring-blue-300 dark:peer-focus:lnfb-ring-blue-800 dark:lnfb-bg-gray-700 peer-checked:after:lnfb-translate-x-full peer-checked:after:lnfb-border-white after:lnfb-content-[''] after:lnfb-absolute after:lnfb-top-0.5 after:lnfb-left-[2px] after:lnfb-bg-white after:lnfb-border-gray-300 after:lnfb-border after:lnfb-rounded-full after:lnfb-h-5 after:lnfb-w-5 after:lnfb-transition-all dark:lnfb-border-gray-600 peer-checked:lnfb-bg-blue-600" />
            <span v-text="label"
                  class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300" />
        </label>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { v4 as uuidv4 } from 'uuid';

defineProps(['modelValue', 'label'])
defineEmits(['update:modelValue'])

const uuid = ref('')

onMounted(() => {
    uuid.value = uuidv4()
})
</script>
