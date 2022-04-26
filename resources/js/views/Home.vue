<template>
    <div class="mb-4">
        <div class="flex">
            <div class="w-2/3 px-2">
                <div class="wrapper--forms">
                    <el-form>
                        <template v-for="(eachFormObj, eachFormIndex) in forms" :key="`div-${eachFormIndex}`">
                            <div class="section-block mb-4">
                                <div class="source">
                                    <div class="flex flex-wrap">
                                        <div class="w-full text-xs text-bold"
                                             :class="{
                                                'mb-2': forms.length > 1,
                                             }">
                                            {{ __('section') }} <span v-text="eachFormIndex + 1"></span>
                                        </div>
                                        <div class="w-3/5">
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
                                        <div class="w-2/5"
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
                                        <draggable :list="eachFormObj.fields"
                                                   class="dragArea flex flex-wrap -mx-3 mb-2"
                                                   :class="{
                                                       'py-6 border-dashed border-4 border-30': !eachFormObj.fields.length,
                                                   }"
                                                   :group="{ name:'formbuilder', pull:false, put:true }"
                                                   :sort="true"
                                                   ghost-class="sortable__ghost">
                                            <div v-for="(field, index) in eachFormObj.fields"
                                                 :key="index"
                                                 v-bind="field"
                                                 class="p-3 mb-3 md:mb-0 form__group"
                                                 :class="{
                                                        'is--active': field === activeField,
                                                        'w-1/3': field.col === 1,
                                                        'w-1/2': field.col === 2,
                                                        'w-full': field.col === 3
                                                    }">
                                                <span class="form__selectedlabel">{{ field.text }}</span>

                                                <div @click="editElementProperties(field)">
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
                                            </div>
                                        </draggable>
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
                 class="wrapper--sidebar w-1/3 px-2">
                <el-tabs class="js-sticky-tab"
                         data-margin-top="10px"
                         type="border-card"
                         v-model="activeTabForFields"
                >
                    <el-tab-pane
                            name="elements"
                            :label="__('fields_elements')">
                        <elements :fields="fields"
                                  :dropElementOptions="dropElementOptions"/>
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
    import Draggable from 'vuedraggable'
    import Properties from '@/components/Properties'
    import {mapGetters} from 'vuex'

    export default {
        name: 'Home',
        props: [
            'fields',
            'dropElementOptions',
            'options',
            'sortElementOptions',
        ],
        components: {
            Draggable,
            Elements,
            Properties,
        },
        data() {
            return {
                sidebarSticky: null,
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

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .empty-section {
        text-align: center;
        font-size: 40px;
        background: linear-gradient(to bottom, #FFF, #409EFF);
        -webkit-text-fill-color: transparent;
        -webkit-background-clip: text;
    }

    .dragArea {
        margin-left: auto;
        margin-right: auto;
        position: relative;
        min-height: 10px;
        //height: calc(30vh);
        z-index: 2;
    }

    .el-main-left {
        //height: calc(90vh);
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

    .form__actionitem--move {
        position: absolute;
        right: -14px;
        top: 50%;
        transform: translateY(-50%);
        visibility: hidden;
    }

    .form__actionitem--move:active,
    .form__actionitem--move:focus,
    .form__actionitem--move:hover {
         border-color: #409EFF;
         background: #ECF5FF;
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
