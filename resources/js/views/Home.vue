<template>
    <div class="lnfb-mb-4">
        <div class="flex">
            <div class="lnfb-w-2/3 lnfb-px-2">
                <div class="wrapper--forms">
                    <el-form>
                        <template v-for="(eachFormObj, eachFormIndex) in forms"
                                  :key="`div-${eachFormIndex}`"
                        >
                            <div class="section-block lnfb-mb-4">
                                <div class="source">
                                    <div class="flex flex-wrap">
                                        <div class="w-full text-xs text-bold"
                                             :class="{
                                                'lnfb-mb-2': forms.length > 1,
                                             }">
                                            {{ __('section') }} <span v-text="eachFormIndex + 1"></span>
                                        </div>
                                        <div class="lnfb-w-2/3">
                                            <div v-if="forms.length > 1">
                                                <label class="block text-sm font-bold mb-2"
                                                       v-bind:for="`section-title-${eachFormIndex}`">
                                                    {{ __('section_title') }}
                                                </label>
                                                <el-input :id="`section-title-${eachFormIndex}`"
                                                          v-model="eachFormObj.title"
                                                          style="width: 100%;"></el-input>
                                            </div>
                                        </div>
                                        <div class="lnfb-w-1/3"
                                             v-if="eachFormIndex > 0">
                                            <el-button type="danger"
                                                       round
                                                       style="float: right"
                                                       @click="deleteSection(eachFormIndex, eachFormObj.title)">
                                                {{ __('delete_section') }}
                                            </el-button>
                                        </div>
                                    </div>
                                </div>
                                <div class="meta p-4">
                                    <el-row v-if="!eachFormObj.fields.length">
                                        <div class="text-center italic mb-4">
                                            {{ __('drop_elements_bellow') }}
                                        </div>
                                    </el-row>
                                    <el-row>
                                        <div
                                             ref="dragArea"
                                             class="js-dragArea dragArea flex flex-wrap w-full"
                                             :class="{
                                                       'w-full lnfb-py-6 lnfb-border-dashed lnfb-border-4 lnfb-border-30': !eachFormObj.fields.length,
                                             }"
                                             @drop="onDrop($event, eachFormIndex, eachFormObj.fields)"
                                             @dragover.prevent="onDragOver($event, eachFormIndex, eachFormObj.fields)"
                                             @dragleave.prevent="onDragLeave($event, eachFormIndex, eachFormObj.fields)"
                                             @dragenter.prevent
                                        >
                                            <div v-for="field in eachFormObj.fields"
                                                  class="js-field mb-3 md:mb-0 form__group lnfb-relative lnfb-p-2"
                                                 :class="{
                                                        'is--active': field === activeField,
                                                        'lnfb-w-1/3': field.col === 1,
                                                        'lnfb-w-1/2': field.col === 2,
                                                        'lnfb-w-full': field.col === 3
                                                    }"
                                                 draggable="true"
                                                 @dragstart="startSortableDrag($event, field)"
                                                 @dragend="endSortableDrag($event)"
                                                 @dragover.prevent
                                                 @dragenter.prevent
                                                 @click="editElementProperties(field)"
                                            >
                                                <div class="js-top-field lnfb-absolute lnfb-z-50 lnfb-top-0 lnfb-left-0 lnfb-right-0 lnfb-h-1/2 lnfb-w-full"></div>
                                                <span class="form__selectedlabel">{{ field.text }}</span>
                                                <div>
                                                    <component :is="field.fieldType"
                                                               :currentField="field"
                                                               class="form__field">
                                                    </component>
                                                </div>
                                                <div class="form__actiongroup">
                                                    <div class="form__actionlist">
                                                        <button
                                                            class="border border-60 bg-20 p-1 leading-none"
                                                            type="button"
                                                            @click="cloneElement(eachFormIndex, index, field, eachFormObj.fields)"
                                                            v-show="!field.isUnique">
                                                            <svg class="svg-icon" viewBox="0 0 20 20" width="20">
                                                                <path fill="currentColor" d="M18.783,13.198H15.73c-0.431,0-0.78-0.35-0.78-0.779c0-0.433,0.349-0.78,0.78-0.78h2.273V3.652H7.852v0.922
                                    c0,0.433-0.349,0.78-0.78,0.78c-0.431,0-0.78-0.347-0.78-0.78V2.872c0-0.43,0.349-0.78,0.78-0.78h11.711
                                    c0.431,0,0.78,0.35,0.78,0.78v9.546C19.562,12.848,19.214,13.198,18.783,13.198z"></path>
                                                                <path fill="currentColor" d="M12.927,17.908H1.217c-0.431,0-0.78-0.351-0.78-0.78V7.581c0-0.43,0.349-0.78,0.78-0.78h11.709
                                    c0.431,0,0.78,0.35,0.78,0.78v9.546C13.706,17.557,13.357,17.908,12.927,17.908z M1.997,16.348h10.15V8.361H1.997V16.348z"></path>
                                                            </svg>
                                                        </button>
                                                        <button
                                                            class="text-danger border border-60 bg-20 p-1 leading-none"
                                                            type="button"
                                                            @click="deleteElement(index, eachFormObj.fields)">
                                                            <svg class="svg-icon" viewBox="0 0 20 20" width="20">
                                                                <path fill="currentColor"
                                                                      d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="js-bottom-field lnfb-absolute lnfb-z-50 lnfb-bottom-0 lnfb-left-0 lnfb-right-0 lnfb-h-1/2"></div>
                                            </div>
                                        </div>
                                    </el-row>
                                </div>
                            </div>
                        </template>
                    </el-form>

                    <el-button style="margin-bottom: 10px;" type="primary" @click="addSection">
                        {{ __('add_section') }}
                    </el-button>
                </div>
            </div>
            <div data-sticky-container
                 class="wrapper--sidebar lnfb-w-1/3 lnfb-px-2">
                <el-tabs class="js-sticky-tab"
                         data-margin-top="10px"
                         type="border-card"
                         v-model="activeTabForFields"
                >
                    <el-tab-pane
                        name="elements"
                        :label="__('fields_elements')">
                        <elements :fields="fields" />
                    </el-tab-pane>

                    <el-tab-pane v-if="Object.keys(this.activeField).length > 0"
                                 name="properties"
                                 :label="__('current_field_properties')">
                        <properties :options="options"></properties>
                    </el-tab-pane>
                </el-tabs>
            </div>
        </div>
    </div>
</template>

<script>
    import Elements from '@/components/Elements'
    import Properties from '@/components/Properties'
    import {mapGetters} from 'vuex'
    import { v4 as uuidv4 } from "uuid";
    import { insertNodeAt } from "../utils/helpers";

    export default {

        props: [
            'fields',
            'options',
        ],
        components: {
            Elements,
            Properties,
        },
        data() {
            return {
                sidebarSticky: null,
                sortableSelected: null,
            }
        },
        mounted() {
            this.initSticky();
        },
        methods: {
            initSticky() {
                if (this.sidebarSticky === null) {
                    const Sticky = require('sticky-js');
                    this.sidebarSticky = new Sticky('.js-sticky-tab');
                }
            },
            onDrop(evt, sectionIndex, fields) {
                if (this.sortableSelected) {
                    return;
                }

                const ghostIndex = [...this.$refs.dragArea[sectionIndex].children].findIndex(c => c.classList.contains('js-ghost'));
                if (ghostIndex === -1) {
                    return;
                }

                this.$refs.dragArea[sectionIndex].querySelectorAll(".js-ghost").forEach(e => e.remove());

                const fieldType = evt.dataTransfer.getData('fieldType')
                const field = this.fields.find((item) => item.fieldType == fieldType)
                const clonedField = _.cloneDeep(field);
                if (clonedField.hasOwnProperty('name')) {
                    clonedField.name = uuidv4();
                }

                let formsTmp = this.forms;
                fields.splice(ghostIndex, 0, clonedField);
                formsTmp[sectionIndex]['fields'] = fields
                this.forms = formsTmp;
            },
            onDragLeave(evt, sectionIndex, fields) {
                if (this.sortableSelected) {
                    return;
                }

                this.$refs.dragArea[sectionIndex].querySelectorAll(".js-ghost").forEach(e => e.remove());
            },
            onDragOver(evt, sectionIndex, fields) {
                if (this.sortableSelected) {
                    return;
                }

                const parent = evt.target.closest('.js-dragArea');
                if (parent == null)
                    return;

                parent.querySelectorAll(".js-ghost").forEach(e => e.remove());

                if (evt.target.classList.contains('js-top-field')) {
                    const field = evt.target.closest('.js-field');
                    const nodeIndex = [...parent.children].findIndex(c => c == field);
                    if (nodeIndex !== -1) {
                        parent.insertBefore(this.ghostNode(), field);
                        return;
                    }
                }

                if (evt.target.classList.contains('js-bottom-field')) {
                    const field = evt.target.closest('.js-field');
                    const nodeIndex = [...parent.children].findIndex(c => c == field);
                    if (nodeIndex !== -1) {
                        if (parent.lastChild == field) {
                            parent.appendChild(this.ghostNode());
                        } else {
                            parent.insertBefore(this.ghostNode(), field.nextSibling);
                        }
                        return;
                    }
                }

                if (parent === evt.target) {
                    parent.appendChild(this.ghostNode());
                }
            },
            startSortableDrag(evt, field) {
                this.sortableSelected = field;
                evt.dataTransfer.dropEffect = 'move';
                evt.dataTransfer.effectAllowed = 'move';
            },
            endSortableDrag(evt) {
                this.sortableSelected = null;
            },
            deleteElement(index, form) {
                this.$confirm(this.__('are_your_sure_delete_field'), this.__('warning'), {
                    confirmButtonText: this.__('yes_delete'),
                    cancelButtonText: this.__('cancel'),
                    type: 'warning'
                }).then(() => {
                    this.activeField = [];
                    this.activeTabForFields = "elements";
                    this.$delete(form, index);
                });
            },
            cloneElement(sectionIndex, index, field, form) {
                const cloned = _.cloneDeep(field)
                let formsTmp = this.forms;
                form.push(cloned);
                formsTmp[sectionIndex]['fields'] = form
                this.forms = formsTmp;

                this.$toasted.show('Champ dupliqué à la fin de la section.', {type: 'success'})
            },
            editElementProperties(field) {
                this.activeField = field;
                this.activeTabForFields = "properties";
            },
            addSection() {
                const formObj = {
                    title: "",
                    fields: []
                };
                this.forms.push(formObj);
            },
            deleteSection(formIndex, formTitle) {
                this.$confirm(this.__('are_your_sure_delete_section'), this.__('warning'), {
                    confirmButtonText: this.__('yes_delete'),
                    cancelButtonText: this.__('cancel'),
                    type: 'warning'
                }).then(() => {
                    this.$delete(this.forms, formIndex);
                });
            },
            ghostNode()
            {
                const ghost = document.createElement("div");
                ghost.classList.add(
                    'js-ghost',
                    'ghost-field',
                    'lnfb-bg-red-500',
                    'lnfb-p-2',
                    'lnfb-w-1/2',
                    'lnfb-text-center',
                    'lnfb-text-sm',
                );
                ghost.appendChild(document.createTextNode('Drag it here'))

                return ghost;
            }
        },
        computed: {
            ...mapGetters('laravel_form_builder_datastore', {
                formsFromStore: 'forms',
                activeFieldFromStore: 'activeField',
                activeTabForFieldsFromStore: 'activeTabForFields'
            }),
            forms: {
                get() {
                    return this.formsFromStore
                },
                set(value) {
                    return this.$store.commit('laravel_form_builder_datastore/forms', value)
                }
            },
            activeField: {
                get() {
                    return this.activeFieldFromStore
                },
                set(value) {
                    return this.$store.commit('laravel_form_builder_datastore/activeField', value)
                }
            },
            activeTabForFields: {
                get() {
                    return this.activeTabForFieldsFromStore
                },
                set(value) {
                    return this.$store.commit('laravel_form_builder_datastore/activeTabForFields', value)
                }
            },
        },
        watch: {
            activeTabForFields: function(val) {
                if (val === 'properties' && this.sidebarSticky !== null) {
                    this.sidebarSticky.destroy();
                    this.sidebarSticky = null;
                    const tabs = document.querySelector('.js-sticky-tab');
                    if (tabs) {
                        // Bugfix with sticky destroy
                        tabs.removeAttribute('style');
                    }
                } else if(val !== 'properties') {
                    this.initSticky();
                }
            }
        }
    }
</script>

<style scoped>
    .dragArea {
        margin-left: auto;
        margin-right: auto;
        position: relative;
        min-height: 10px;
        //height: calc(30vh);
        z-index: 2;
    }

    .form__selectedlabel {
        display: none;
        background: #ECF5FF;
        padding: 3px 5px;
        color: black;
        font-size: 10px;
        position: absolute;
        top: -17px;
        right: 15px;
    }

    .form__actionlist {
        position: absolute;
        visibility: hidden;
        z-index: 3;
        right: 1rem;
    }

    .form__group {
        border: 1px solid transparent;
        position: relative;

    }

    .form__group:hover {
         border-color: #409EFF;
    }

    .form__group:hover .form__actionitem--move,
    .form__group:hover .form__actionlist {
        visibility: visible;
    }


    .form__group.is--active {
        border-color: #409EFF;
        background: #ECF5FF;
    }

    .form__group.is--active .form__actionlist {
        visibility: visible;
    }

    .form__group.is--active .form__selectedlabel {
        display: inline-block;
    }

    .section-block {
        border: 1px solid #ebebeb;
        border-radius: 3px;
    }

    .section-block .source {
        padding: 10px
    }

    .section-block .meta {
        background-color: #FFF;
        border-top: 1px solid #eaeefb;
    }
</style>
