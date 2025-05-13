<template>
  <div>
    <label
      v-bind:for="uuid"
      v-text="label"
      class="lnfb-block lnfb-mb-2 lnfb-text-sm lnfb-font-medium lnfb-text-gray-900 dark:lnfb-text-white"
    />

    <select
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      v-bind:id="uuid"
      class="lnfb-w-full lnfb-block form-control form-control-bordered form-input"
    >
      <option v-for="option in options" :value="option.value">
        {{ option.name }}
      </option>
    </select>
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
  options: {
    type: Array,
    required: true,
  },
});

defineEmits(['update:modelValue']);

const uuid = ref('');

onMounted(() => {
  uuid.value = uuidv4();
});
</script>
