<template>
  <div class="lnfb-mb-4">
    <div class="lnfb-flex lnfb-items-start">
      <div class="lnfb-w-2/3 lnfb-pr-2">
        <div>
          <template v-for="(eachFormObj, sectionIndex) in forms" :key="`div-${sectionIndex}`">
            <LnfbDeleteSectionModal
              :show="sectionToDelete === eachFormObj"
              @close="sectionToDelete = null"
              @confirm="deleteSection(sectionIndex)"
            />

            <div class="section-block lnfb-mb-4">
              <div class="lnfb-p-2">
                <div class="lnfb-flex lnfb-flex-wrap">
                  <div
                    class="lnfb-w-full lnfb-text-xs lnfb-text-bold"
                    :class="{
                      'lnfb-mb-2': forms.length > 1,
                    }"
                  >
                    {{ __('section') }} <span v-text="sectionIndex + 1"></span>
                  </div>
                  <div class="lnfb-w-2/3">
                    <div v-if="forms.length > 1">
                      <label
                        class="lnfb-block lnfb-text-sm lnfb-font-bold lnfb-mb-2"
                        v-bind:for="`section-title-${sectionIndex}`"
                      >
                        {{ __('section_title') }}
                      </label>
                      <input
                        type="text"
                        :id="`section-title-${sectionIndex}`"
                        class="form-input lnfb-w-full form-control form-control-bordered"
                        v-model="eachFormObj.title"
                      />
                    </div>
                  </div>
                  <div class="lnfb-w-1/3 lnfb-text-right" v-if="sectionIndex > 0">
                    <LnfbDangerButton
                      type="submit"
                      @click="sectionToDelete = eachFormObj"
                      size="sm"
                    >
                      {{ __('delete_section') }}
                    </LnfbDangerButton>
                  </div>
                </div>
              </div>
              <div class="meta p-4">
                <div class="text-center italic mb-4" v-if="!eachFormObj.fields.length">
                  {{ __('drop_elements_bellow') }}
                </div>
                <div
                  ref="dragArea"
                  class="js-dragArea dragArea flex flex-wrap w-full"
                  :class="{
                    'w-full lnfb-py-6 lnfb-border-dashed lnfb-border-4 lnfb-border-30':
                      !eachFormObj.fields.length,
                  }"
                  @drop="onDrop($event, sectionIndex, eachFormObj.fields)"
                  @dragover.prevent="onDragOver($event, sectionIndex, eachFormObj.fields)"
                  @dragleave.prevent="onDragLeave($event, sectionIndex, eachFormObj.fields)"
                  @dragenter.prevent
                >
                  <div
                    v-for="(field, fieldIndex) in eachFormObj.fields"
                    class="js-field mb-3 md:mb-0 form__group lnfb-relative lnfb-p-2"
                    :class="{
                      'is--active': field === activeField,
                      'lnfb-w-1/3': field.col === 1,
                      'lnfb-w-2/3': field.col === 2,
                      'lnfb-w-full': field.col === 3 || !field.col,
                    }"
                    draggable="true"
                    @dragstart="startSortableDrag($event, field)"
                    @dragend="endSortableDrag($event)"
                    @dragover.prevent
                    @dragenter.prevent
                    @click="editElementProperties(field)"
                  >
                    <div
                      class="js-top-field lnfb-absolute lnfb-z-50 lnfb-top-0 lnfb-left-0 lnfb-right-0 lnfb-h-1/2 lnfb-w-full"
                    ></div>
                    <span class="form__selectedlabel">{{ field.text }}</span>
                    <div>
                      <component
                        :is="`Lnfb${field.fieldType}`"
                        :currentField="field"
                        class="form__field"
                      >
                      </component>
                    </div>
                    <div class="field-action-list lnfb-relative lnfb-mt-2 lnfb-text-right">
                      <button
                        class="lnfb-border lnfb-border-60 lnfb-bg-20 lnfb-p-1 lnfb-leading-none"
                        type="button"
                        @click="cloneElement(sectionIndex, fieldIndex, field, eachFormObj.fields)"
                        v-show="!field.isUnique"
                      >
                        <svg class="svg-icon" viewBox="0 0 20 20" width="20">
                          <path
                            fill="currentColor"
                            d="M18.783,13.198H15.73c-0.431,0-0.78-0.35-0.78-0.779c0-0.433,0.349-0.78,0.78-0.78h2.273V3.652H7.852v0.922
                                c0,0.433-0.349,0.78-0.78,0.78c-0.431,0-0.78-0.347-0.78-0.78V2.872c0-0.43,0.349-0.78,0.78-0.78h11.711
                                c0.431,0,0.78,0.35,0.78,0.78v9.546C19.562,12.848,19.214,13.198,18.783,13.198z"
                          ></path>
                          <path
                            fill="currentColor"
                            d="M12.927,17.908H1.217c-0.431,0-0.78-0.351-0.78-0.78V7.581c0-0.43,0.349-0.78,0.78-0.78h11.709
                                c0.431,0,0.78,0.35,0.78,0.78v9.546C13.706,17.557,13.357,17.908,12.927,17.908z M1.997,16.348h10.15V8.361H1.997V16.348z"
                          ></path>
                        </svg>
                      </button>
                      <button
                        class="lnfb-text-red-500 lnfb-border lnfb-border-60 lnfb-bg-20 lnfb-p-1 lnfb-leading-none"
                        type="button"
                        @click="fieldToDelete = field"
                      >
                        <svg class="svg-icon" viewBox="0 0 20 20" width="20">
                          <path
                            fill="currentColor"
                            d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"
                          ></path>
                        </svg>
                      </button>
                    </div>
                    <div
                      class="js-bottom-field lnfb-absolute lnfb-z-50 lnfb-bottom-0 lnfb-left-0 lnfb-right-0 lnfb-h-1/2"
                    ></div>

                    <LnfbDeleteFieldModal
                      :show="fieldToDelete === field"
                      :field="field"
                      @close="fieldToDelete = null"
                      @confirm="deleteElement(sectionIndex, fieldIndex, eachFormObj.fields)"
                    />
                  </div>
                </div>
              </div>
            </div>
          </template>
        </div>

        <LnfbBasicButton @click="addSection">
          {{ __('add_section') }}
        </LnfbBasicButton>
      </div>
      <div
        class="lnfb-w-1/3 lnfb-px-2 lnfb-sticky lnfb-top-2 lnfb-overflow-hidden lnfb-bg-white dark:lnfb-bg-gray-800 lnfb-rounded-lg lnfb-shadow lnfb-divide-y lnfb-divide-gray-100 dark:lnfb-divide-gray-700"
      >
        <div class="lnfb-border-b lnfb-border-gray-200 lnfb-mb-4">
          <nav class="lnfb--mb-px lnfb-flex lnfb-space-x-8" aria-label="Tabs">
            <a
              href="#"
              @click.prevent="showFieldsTab"
              :class="{
                'lnfb-border-indigo-500 lnfb-text-indigo-600':
                  Object.keys(this.activeField).length === 0,
                'lnfb-border-transparent lnfb-text-gray-500 hover:lnfb-text-gray-700 hover:lnfb-border-gray-300':
                  Object.keys(this.activeField).length > 0,
              }"
              class="lnfb-whitespace-nowrap lnfb-py-4 lnfb-px-1 lnfb-border-b-2 lnfb-font-medium lnfb-text-sm"
            >
              Champs
            </a>

            <a
              href="#"
              v-if="Object.keys(this.activeField).length > 0"
              class="lnfb-border-indigo-500 lnfb-text-indigo-600 lnfb-whitespace-nowrap lnfb-py-4 lnfb-px-1 lnfb-border-b-2 lnfb-font-medium lnfb-text-sm"
            >
              Propriétés du champs
            </a>
          </nav>
        </div>
        <div>
          <div v-if="Object.keys(this.activeField).length === 0">
            <elements :fields="fields" />
          </div>

          <div v-if="Object.keys(this.activeField).length > 0">
            <properties :options="options"></properties>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Elements from '@/components/Elements';
import Properties from '@/components/Properties';
import { mapGetters } from 'vuex';
import { v4 as uuidv4 } from 'uuid';

export default {
  props: ['fields', 'options'],
  components: {
    Elements,
    Properties,
  },
  data() {
    return {
      sortableSelected: null,
      fieldToDelete: null,
      sectionToDelete: null,
    };
  },
  methods: {
    onDrop(evt, sectionIndex, fields) {
      if (this.sortableSelected) {
        this.onDropSortablePosition(evt, sectionIndex, fields);
        return;
      }

      const ghostIndex = [...this.$refs.dragArea[sectionIndex].children].findIndex((c) =>
        c.classList.contains('js-ghost')
      );
      if (ghostIndex === -1) {
        return;
      }

      this.$refs.dragArea[sectionIndex].querySelectorAll('.js-ghost').forEach((e) => e.remove());

      const fieldType = evt.dataTransfer.getData('fieldType');
      const field = this.fields.find((item) => item.fieldType == fieldType);
      const clonedField = _.cloneDeep(field);
      if (clonedField.hasOwnProperty('name')) {
        clonedField.name = uuidv4();
      }

      let formsTmp = this.forms;
      fields.splice(ghostIndex, 0, clonedField);
      formsTmp[sectionIndex]['fields'] = fields;
      this.forms = formsTmp;
    },
    onDropSortablePosition(evt, sectionIndex, fields) {
      let ghostIndex = [...this.$refs.dragArea[sectionIndex].children].findIndex((c) =>
        c.classList.contains('js-ghost')
      );
      if (ghostIndex === -1) {
        this.sortableSelected = null;

        return;
      }

      const fieldName = this.sortableSelected.name;
      const currentIndex = fields.findIndex((f) => f.name === fieldName);
      if (currentIndex === -1) {
        this.sortableSelected = null;

        return;
      }

      if (ghostIndex === currentIndex) {
        this.sortableSelected = null;

        return;
      }

      // Delete field from array
      fields.splice(currentIndex, 1);
      // Delete ghost from DOM
      this.$refs.dragArea[sectionIndex].querySelectorAll('.js-ghost').forEach((e) => e.remove());
      if (ghostIndex > currentIndex) {
        ghostIndex--;
      }
      // Re-insert field at selected index
      fields.splice(ghostIndex, 0, _.cloneDeep(this.sortableSelected));

      let formsTmp = this.forms;
      formsTmp[sectionIndex]['fields'] = fields;
      this.forms = formsTmp;
      this.sortableSelected = null;
    },
    onDragLeave(evt, sectionIndex, fields) {
      if (this.sortableSelected) {
        return;
      }

      this.$refs.dragArea[sectionIndex].querySelectorAll('.js-ghost').forEach((e) => e.remove());
    },
    onDragOver(evt, sectionIndex, fields) {
      const parent = evt.target.closest('.js-dragArea');
      if (parent == null) return;

      parent.querySelectorAll('.js-ghost').forEach((e) => e.remove());

      if (evt.target.classList.contains('js-top-field')) {
        const field = evt.target.closest('.js-field');
        const nodeIndex = [...parent.children].findIndex((c) => c == field);
        if (nodeIndex !== -1) {
          parent.insertBefore(this.ghostNode(this.sortableSelected ? true : false), field);
          return;
        }
      }

      if (evt.target.classList.contains('js-bottom-field')) {
        const field = evt.target.closest('.js-field');
        const nodeIndex = [...parent.children].findIndex((c) => c == field);
        if (nodeIndex !== -1) {
          if (parent.lastChild == field) {
            parent.appendChild(this.ghostNode(this.sortableSelected ? true : false));
          } else {
            parent.insertBefore(
              this.ghostNode(this.sortableSelected ? true : false),
              field.nextSibling
            );
          }
          return;
        }
      }

      if (parent === evt.target) {
        parent.appendChild(this.ghostNode(this.sortableSelected ? true : false));
      }
    },
    startSortableDrag(evt, field) {
      evt.target.classList.add('drag-position-in-progress');
      this.sortableSelected = field;
      evt.dataTransfer.dropEffect = 'move';
      evt.dataTransfer.effectAllowed = 'move';
    },
    endSortableDrag(evt) {
      this.sortableSelected = null;
      evt.target.classList.remove('drag-position-in-progress');
    },
    deleteElement(sectionIndex, fieldIndex, fields) {
      this.activeField = [];
      this.activeTabForFields = 'elements';

      let formsTmp = this.forms;
      fields.splice(fieldIndex, 1);
      formsTmp[sectionIndex]['fields'] = fields;

      this.forms = formsTmp;
    },
    cloneElement(sectionIndex, index, field, form) {
      const cloned = _.cloneDeep(field);
      let formsTmp = this.forms;
      cloned.name = uuidv4();
      form.push(cloned);
      formsTmp[sectionIndex]['fields'] = form;
      this.forms = formsTmp;

      Nova.success('Champ dupliqué à la fin de la section.');
    },
    showFieldsTab() {
      this.activeField = {};
      this.activeTabForFields = 'elements';
    },
    editElementProperties(field) {
      this.activeField = field;
      this.activeTabForFields = 'properties';
    },
    addSection() {
      const formObj = {
        title: '',
        fields: [],
      };
      this.forms.push(formObj);
    },
    deleteSection(formIndex) {
      let formsTmp = this.forms;
      formsTmp.splice(formIndex, 1);

      this.forms = formsTmp;
    },
    ghostNode(isSortableGhost) {
      const ghost = document.createElement('div');
      ghost.classList.add(
        'js-ghost',
        'ghost-field',
        'lnfb-bg-sky-200',
        'lnfb-p-2',
        'lnfb-w-1/2',
        'lnfb-text-center',
        'lnfb-text-sm'
      );

      ghost.appendChild(
        document.createTextNode(isSortableGhost ? this.__('move_it_here') : this.__('drop_it_here'))
      );

      return ghost;
    },
  },
  computed: {
    ...mapGetters('laravel_form_builder_datastore', {
      formsFromStore: 'forms',
      activeFieldFromStore: 'activeField',
      activeTabForFieldsFromStore: 'activeTabForFields',
    }),
    forms: {
      get() {
        return this.formsFromStore;
      },
      set(value) {
        return this.$store.commit('laravel_form_builder_datastore/forms', value);
      },
    },
    activeField: {
      get() {
        return this.activeFieldFromStore;
      },
      set(value) {
        return this.$store.commit('laravel_form_builder_datastore/activeField', value);
      },
    },
    activeTabForFields: {
      get() {
        return this.activeTabForFieldsFromStore;
      },
      set(value) {
        return this.$store.commit('laravel_form_builder_datastore/activeTabForFields', value);
      },
    },
  },
};
</script>

<style scoped lang="postcss">
.dragArea {
  margin-left: auto;
  margin-right: auto;
  position: relative;
  min-height: 10px;
}

.form__selectedlabel {
  display: none;
  background: #ecf5ff;
  padding: 3px 5px;
  color: black;
  font-size: 10px;
  position: absolute;
  top: -17px;
  right: 15px;
}

.field-action-list {
  visibility: hidden;
  z-index: 60;
}

.form__group {
  border: 1px solid transparent;
  position: relative;
}

.drag-position-in-progress {
  opacity: 0.4;
}

.form__group:hover {
  border-color: #409eff;
}

.form__group:hover .form__actionitem--move,
.form__group:hover .field-action-list {
  visibility: visible;
}

.form__group.is--active {
  border-color: #409eff;
  background: #ecf5ff;
}

.form__group.is--active .field-action-list field-action-list {
  visibility: visible;
}

.form__group.is--active .form__selectedlabel {
  display: inline-block;
}

.section-block {
  @apply lnfb-relative lnfb-overflow-hidden lnfb-bg-white dark:lnfb-bg-gray-800 lnfb-rounded-lg lnfb-shadow lnfb-divide-y lnfb-divide-gray-100 dark:lnfb-divide-gray-700;
}

.section-block .meta {
  border-top: 1px solid #eaeefb;
  @apply lnfb-bg-white dark:lnfb-bg-gray-800;
}
</style>
