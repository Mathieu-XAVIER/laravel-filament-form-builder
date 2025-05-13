<template>
  <div>
    <label
      v-bind:for="uuid"
      v-text="label"
      class="lnfb-block lnfb-text-sm lnfb-font-medium lnfb-text-gray-700"
    />

    <div class="lnfb-mt-1">
      <input
        type="number"
        v-bind="$attrs"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        v-bind:id="uuid"
        class="form-input lnfb-w-full form-control form-control-bordered"
        placeholder=""
      />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { v4 as uuidv4 } from 'uuid';

defineProps(['modelValue', 'label']);
defineEmits(['update:modelValue']);

const uuid = ref('');

onMounted(() => {
  uuid.value = uuidv4();
});
</script>
