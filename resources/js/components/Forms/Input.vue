<template>
    <div>
        <label v-bind:for="uuid"
               v-text="label"
               class="lnfb-block lnfb-text-sm lnfb-font-medium lnfb-text-gray-700"/>

        <div class="lnfb-mt-1">
            <input type="text"
                   :value="modelValue"
                   @input="$emit('update:modelValue', $event.target.value)"
                   v-bind:id="uuid"
                   class="form-input lnfb-py-2 lnfb-block lnfb-w-full lnfb-rounded-md lnfb-border-gray-300 lnfb-shadow-sm focus:lnfb-border-indigo-500 focus:lnfb-ring-indigo-500 sm:lnfb-text-sm"
                   placeholder=""/>
        </div>
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
