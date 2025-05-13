<template>
  <div class="w-full form__field">
    <label
      class="lnfb-block lnfb-uppercase lnfb-tracking-wide lnfb-text-gray-700 dark:lnfb-text-gray-400 lnfb-text-xs lnfb-font-bold lnfb-mb-2"
      v-text="currentField.label"
    ></label>

    <div class="flex flex-wrap items-stretch w-full">
      <div v-if="currentField.prepend !== ''" class="flex -mr-px">
        <span
          class="flex items-center leading-normal bg-20 rounded rounded-r-none border border-r-0 border-grey-light px-3 whitespace-no-wrap text-grey-dark text-sm border-60"
          v-text="currentField.prepend"
        ></span>
      </div>

      <input
        v-model="input"
        v-bind="attributesBinding"
        class="form-input lnfb-w-full form-control form-control-bordered bg-gray-50 placeholder:lnfb-text-gray-500"
        :class="{
          'rounded-l-none': currentField.prepend !== '',
          'rounded-r-none': currentField.append !== '',
        }"
      />

      <div v-if="currentField.append !== ''" class="flex -ml-px">
        <span
          class="flex items-center leading-normal bg-20 rounded rounded-l-none border border--0 border-60 border-grey-light px-3 whitespace-no-wrap text-grey-dark text-sm"
          v-text="currentField.append"
        ></span>
      </div>
    </div>

    <div v-if="currentField.help" v-text="currentField.help" class="py-2 help-text"></div>
  </div>
</template>

<script>
export default {
  name: 'TextInput',
  props: ['currentField'],
  data() {
    return {
      input: '',
    };
  },
  computed: {
    attributesBinding() {
      var attr = {};
      if (this.currentField.showWordLimit) {
        attr.maxlength = this.currentField.maxlength;
        attr['show-word-limit'] = this.currentField.showWordLimit;
      }

      if (this.currentField.clearable) {
        attr.clearable = this.currentField.clearable;
      }

      if (this.currentField.isRequired) {
        attr.required = 'required';
      }

      if (this.currentField.disabled) {
        attr.disabled = this.currentField.disabled;
      }

      if (this.currentField.showPassword) {
        attr['show-password'] = this.currentField.showPassword;
      }

      if (this.currentField.isPlaceholderVisible) {
        attr.placeholder = this.currentField.placeholder;
      }

      attr.type = this.currentField.inputType;

      return attr;
    },
  },
};
</script>
