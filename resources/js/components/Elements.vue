<template>
  <div class="el-tabs__inner">
    <div class="flex flex-wrap">
      <div
        v-for="field in fields"
        class="lnfb-px-1 lnfb-mb-2 lnfb-w-1/2 field-element"
        :class="{ 'is-disabled': checkStopDragCondition(field) }"
      >
        <button
          type="button"
          :draggable="!checkStopDragCondition(field)"
          @dragstart="startDrag($event, field)"
          @dragend="endDrag($event)"
          class="button__sidebar lnfb-cursor-grab lnfb-w-full lnfb-items-center lnfb-border lnfb-border-gray-300 lnfb-bg-white lnfb-px-2.5 lnfb-py-1.5 lnfb-text-xs lnfb-font-medium lnfb-text-gray-700 lnfb-shadow-sm hover:lnfb-bg-gray-50 lnfb-focus:outline-none lnfb-focus:ring-2 lnfb-focus:ring-indigo-500 lnfb-focus:ring-offset-2"
        >
          {{ field.text }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { v4 as uuidv4 } from 'uuid';
import { mapGetters } from 'vuex';

export default {
  name: 'Elements',
  props: ['fields', 'dropElementOptions'],
  methods: {
    startDrag(evt, field) {
      evt.target.classList.add('sortable__ghost');
      evt.dataTransfer.dropEffect = 'move';
      evt.dataTransfer.effectAllowed = 'move';
      evt.dataTransfer.setData('fieldType', field.fieldType);
    },
    endDrag(event) {
      event.target.classList.remove('sortable__ghost');
    },
    clone(field) {
      const clonedField = _.cloneDeep(field);
      if (clonedField.hasOwnProperty('name')) {
        clonedField.name = uuidv4();
      }

      return clonedField;
    },
    checkStopDragCondition(field) {
      if (!field.isUnique) {
        return false;
      }

      let form = this.forms,
        formArray = [];

      form.forEach(function (section, sectionKey) {
        section.fields.forEach(function (field, key) {
          formArray.push(field['fieldType']);
        });
      });

      return _.includes(formArray, field.fieldType) && field.isUnique;
    },
  },
  computed: {
    ...mapGetters('laravel_form_builder_datastore', {
      formsFromStore: 'forms',
    }),
    forms: {
      get() {
        return this.formsFromStore;
      },
      set(value) {
        return this.$store.commit('laravel_form_builder_datastore/forms', value);
      },
    },
  },
};
</script>

<style scoped>
.el-tabs__inner .sortable__ghost {
  opacity: 0.4;
}

.el-tabs__inner .is-disabled .button__sidebar {
  cursor: not-allowed;
  opacity: 0.4;
}
</style>
