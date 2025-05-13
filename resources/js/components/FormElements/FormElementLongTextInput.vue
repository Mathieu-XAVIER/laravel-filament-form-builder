<template>
  <div class="lnfb-w-full">
    <label
      class="lnfb-block lnfb-uppercase lnfb-tracking-wide lnfb-text-gray-700 dark:lnfb-text-gray-400 lnfb-text-xs lnfb-font-bold lnfb-mb-2"
      v-text="currentField.label"
    ></label>

    <textarea
      class="form-input lnfb-w-full form-control form-control-bordered bg-gray-50 lnfb-h-auto"
      v-model="textarea"
      :placeholder="currentField.isPlaceholderVisible ? currentField.placeholder : ''"
      v-bind="attributesBinding"
    ></textarea>

    <div v-if="currentField.help" v-text="currentField.help" class="lnfb-py-2 lnfb-text-sm"></div>
  </div>
</template>

<script>
export default {
  name: 'LongTextInput',
  props: ['currentField'],
  data() {
    return {
      textarea: '',
    };
  },
  computed: {
    attributesBinding() {
      var attr = {};

      if (this.currentField.disabled) {
        attr.disabled = 'disabled';
      }

      attr.rows = 5;
      if (this.currentField.rows) {
        attr.rows = parseInt(this.currentField.rows, 10);
      }

      return attr;
    },
  },
};
</script>
