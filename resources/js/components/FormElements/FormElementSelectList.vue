<template>
  <div class="lnfb-w-full">
    <label class="lnfb-block lnfb-uppercase lnfb-tracking-wide lnfb-text-gray-700 lnfb-text-xs lnfb-font-bold lnfb-mb-2"
           v-text="currentField.label"/>

    <div class="lnfb-relative">
      <select :value="value"
              v-bind="attributesBinding"
              @input.prevent.stop
              class="lnfb-block lnfb-appearance-none lnfb-w-full lnfb-border lnfb-border-gray-200 lnfb-py-3 lnfb-px-4 lnfb-pr-8 lnfb-rounded lnfb-leading-tight focus:lnfb-outline-none focus:lnfb-border-gray-500"
      >
        <option v-for="option in currentField.options"
                :value="option.optionValue"
        >
          {{ option.optionLabel }}
        </option>
      </select>

      <div
        class="lnfb-pointer-events-none lnfb-absolute lnfb-inset-y-0 lnfb-right-0 lnfb-flex lnfb-items-center lnfb-px-2 lnfb-text-gray-700">
        <svg class="lnfb-fill-current lnfb-h-4 lnfb-w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
        </svg>
      </div>
    </div>


    <div v-if="currentField.help"
         v-text="currentField.help"
         class="py-2 text-sm"></div>
  </div>
</template>

<script>
export default {
  name: 'SelectList',
  props: ['currentField'],
  data() {
    return {
      update: true,
      value: "",
      loading: false
    }
  },
  mounted() {
  },
  computed: {
    attributesBinding() {
      var attr = {};
      attr.disabled = this.currentField.disabled;
      attr.clearable = this.currentField.clearable;
      attr.multiple = this.currentField.multiple;

      return attr;
    }
  },
  methods: {
    reload() {
      this.update = false
      this.$nextTick(() => {
        this.update = true
      });
    },
  },
  watch: {
    'currentField.multiple'() {
      this.reload();
    }
  }
}
</script>
