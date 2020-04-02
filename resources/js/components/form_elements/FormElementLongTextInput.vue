<template>
    <div class="w-full">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
               v-text="currentField.label"></label>
        <textarea
            class="w-full form-control form-input form-input-bordered py-3 h-auto"
            v-model="textarea"
            :placeholder="currentField.isPlaceholderVisible ? currentField.placeholder : ''"
            v-bind="attributesBinding"
        />
        <div v-if="currentField.help"
             v-text="currentField.help"
             class="py-2 text-sm"></div>
    </div>
</template>

<script>
export default {
  name: 'LongTextInput',
  props: ['currentField'],
  data() {
    return {
      textarea: ''
    }
  },
    computed: {
        attributesBinding() {
            var attr = {};

            if (this.currentField.disabled) {
                attr.disabled = 'disabled';
            }

            attr.rows = 2;
            if (this.currentField.rows) {
                attr.rows = parseInt(this.currentField.rows, 10);
            }

            return attr;
        },
    }
}
</script>
