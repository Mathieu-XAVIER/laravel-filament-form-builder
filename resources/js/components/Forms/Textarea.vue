<template>
  <div>
    <label
      v-bind:for="uuid"
      v-text="label"
      class="lnfb-block lnfb-text-sm lnfb-font-medium lnfb-text-gray-700"
    />

    <div class="lnfb-mt-1">
      <textarea
        :rows="rows"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        v-bind:id="uuid"
        class="lnfb-w-full form-control form-input lnfb-border lnfb-border-gray-300 lnfb-py-3 lnfb-h-auto"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { v4 as uuidv4 } from 'uuid';

defineProps({
  modelValue: {
    required: true,
  },
  label: {
    required: true,
  },
  rows: {
    type: Number,
    default: 4,
  },
});
defineEmits(['update:modelValue']);

const uuid = ref('');

onMounted(() => {
  uuid.value = uuidv4();
});
</script>
