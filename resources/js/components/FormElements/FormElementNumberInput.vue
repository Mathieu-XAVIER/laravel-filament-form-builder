<template>
  <div class="lnfb-w-full">
    <label
      class="lnfb-block lnfb-uppercase lnfb-tracking-wide lnfb-text-gray-700 dark:lnfb-text-gray-400 lnfb-text-xs lnfb-font-bold lnfb-mb-2"
      v-text="currentField.label"
    ></label>

    <input
      type="number"
      class="form-input form-control form-control-bordered bg-gray-50"
      v-bind="attributesBinding"
    />

    <div v-if="currentField.help" v-text="currentField.help" class="lnfb-py-2 lnfb-text-sm"></div>
  </div>
</template>

<script>
export default {
  name: 'NumberInput',
  props: ['currentField'],
  computed: {
    attributesBinding() {
      var attr = {};
      attr.placeholder = this.currentField.placeholder;

      if (this.currentField.hasMinValue) {
        attr.min = this.currentField.min;
      }
      if (this.currentField.hasMaxValue) {
        attr.max = this.currentField.max;
      }

      return attr;
    },
  },
};
</script>
