<template>
    <div class="el-tabs__inner">
        <el-form :model="fieldProperties" :rules="rules" :label-position="labelPosition" ref="fieldProperties">
            <div class="w-full flex flex-wrap">
                <div class="w-full px-3 mb-3"
                     v-show="activeField.hasOwnProperty('col')">
                    <label class="block text-80 text-sm mb-2"
                           for="field_width">
                        {{ __('field_width') }}
                    </label>
                    <el-input-number v-model="activeField.col"
                                     id="field_width"
                                     :min="1"
                                     :max="3"
                                     controls-position="right">
                    </el-input-number>
                </div>
                <div class="w-full px-3 mb-3"
                     v-if="activeField.fieldType === 'LongTextInput'">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('number_of_rows') }}
                    </label>
                    <el-input-number v-model="activeField.rows"
                                     :min="1"
                                     :max="30"
                                     controls-position="right"></el-input-number>
                </div>
                <div class="w-full px-3 mb-3"
                     v-show="activeField.hasOwnProperty('label')">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('field_label') }}
                    </label>
                    <el-input v-model="activeField.label">
                        {{activeField.label}}
                    </el-input>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.isPlaceholderVisible">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('placeholder') }}
                    </label>
                    <el-input v-show="activeField.isPlaceholderVisible"
                              v-model="activeField.placeholder">
                        {{activeField.placeholder}}
                    </el-input>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.fieldType === 'TextInput'">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('input_type') }}
                    </label>
                    <el-select v-model="activeField.inputType">
                        <el-option :label="__('field_type_text')"
                                   value="text"></el-option>
                        <el-option :label="__('field_type_email')"
                                   value="email"></el-option>
                        <el-option :label="__('field_type_phone')"
                                   value="phone"></el-option>
                        <el-option :label="__('field_type_password')"
                                   value="password"></el-option>
                    </el-select>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.hasOwnProperty('maxlength')">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('chars_limit') }}
                    </label>
                    <el-input-number :min="1"
                                     :max="255"
                                     controls-position="right"
                                     v-model="activeField.maxlength"></el-input-number>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.isHelpBlockVisible">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('help_label') }}
                    </label>
                    <el-input v-model="activeField.help">
                        {{activeField.help}}
                    </el-input>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.hasOwnProperty('consentText')">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('consent_label') }}
                    </label>
                    <el-input
                        type="textarea"
                        :rows="3"
                        v-model="activeField.consentText"></el-input>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.hasOwnProperty('isRequired')">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('is_required_field') }}
                    </label>
                    <el-switch v-model="activeField.isRequired"></el-switch>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.hasOwnProperty('multiple')">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('is_multiple_field') }}
                    </label>
                    <el-switch v-model="activeField.multiple"></el-switch>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.hasOwnProperty('maxSize')">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('file_max_size') }}
                    </label>
                    <upload-input-size></upload-input-size>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.hasOwnProperty('extensions')">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('allowed_extensions') }}
                    </label>
                    <upload-input-extensions></upload-input-extensions>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.hasOwnProperty('recaptchaSiteKey')">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('recaptcha_site_key') }}
                    </label>
                    <el-input type="text"
                              v-model="activeField.recaptchaSiteKey">
                    </el-input>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.hasOwnProperty('recaptchaSiteSecret')">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('recaptcha_site_secret') }}
                    </label>
                    <el-input type="text"
                              v-model="activeField.recaptchaSiteSecret">
                    </el-input>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.hasOwnProperty('buttonText')">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('button_text_label') }}
                    </label>
                    <el-input v-model="activeField.buttonText">
                        {{activeField.buttonText}}
                    </el-input>
                </div>

                <div class="w-full px-3 mb-3"
                     v-if="activeField.options">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('item_options') }}
                    </label>
                    <div class="py-2">
                        <ul class="properties__optionsul">
                            <li class="properties__optionslist flex">
                                <div class="w-2/5 text-xs text-center">
                                    {{ __('option_label') }}
                                </div>
                                <div class="w-2/5 text-xs text-center">
                                    {{ __('option_value') }}
                                </div>
                                <div class="w-1/5 text-xs"></div>
                            </li>
                            <li v-for="(item, index) in activeField.options"
                                :key="index"
                                class="properties__optionslist"
                            >
                                <div class="flex">
                                    <div class="w-2/5 pr-2 text-xs">
                                        <el-input v-model="item.optionLabel">
                                            {{item.optionLabel}}
                                        </el-input>
                                    </div>
                                    <div class="w-2/5 pr-2 text-xs">
                                        <el-input v-model="item.optionValue">
                                            {{item.optionValue}}
                                        </el-input>
                                    </div>
                                    <div class="w-1/5 text-xs">
                                        <el-button @click="deleteOption(activeField.options, index)"
                                                   v-show="activeField.options.length > 1">
                                            <i class="el-icon-error"></i>
                                        </el-button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <el-button type="text" @click="addOption(activeField.options)">
                            <i class="el-icon-plus"></i>
                            {{ __('add_more') }}
                        </el-button>
                    </div>
                </div>
                <div class="w-full px-3 mb-3"
                     v-if="activeField.hasOwnProperty('htmlContent')">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('html_content_label') }}
                    </label>
                    <el-input :rows="10" type="textarea" v-model="activeField.htmlContent">
                        {{activeField.htmlContent}}
                    </el-input>
                </div>
                <div class="w-full px-3 mb-3">
                    <el-button v-show="activeField.hasOwnProperty('advancedOptions') || activeField.group === 'form'"
                               @click="advancedPropsVisible = true"
                               style="width: 100%;" type="success">
                        {{ __('advanced_options') }}
                    </el-button>
                </div>
            </div>

            <el-dialog :close-on-click-modal="false"
                       :title="__('advanced_options')"
                       :visible.sync="advancedPropsVisible">
                <el-form ref="OptionsForm"
                         :rules="dialogRules">

                    <form-element-advanced-props></form-element-advanced-props>

                    <text-input-advanced-props v-if="activeField.fieldType === 'TextInput'"></text-input-advanced-props>

                    <number-input-advanced-props v-if="activeField.fieldType === 'NumberInput'"></number-input-advanced-props>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button type="primary" @click="advancedPropsVisible = !advancedPropsVisible">
                        {{ __('confirm') }}
                    </el-button>
                </div>
            </el-dialog>
        </el-form>
    </div>
</template>

<script>
    import FormElementAdvancedProps from "./form_elements/properties/FormElementAdvancedProps";
    import TextInputAdvancedProps from './form_elements/properties/TextInputAdvancedProps.vue'
    import NumberInputAdvancedProps from './form_elements/properties/NumberInputAdvancedProps.vue'
    import UploadInputExtensions from './form_elements/properties/UploadInputExtensions.vue'
    import UploadInputSize from './form_elements/properties/UploadInputSize.vue'
    import {mapGetters} from 'vuex'

    export default {
        name: 'Properties',
        props: [
            'options',
        ],
        components: {
            FormElementAdvancedProps,
            TextInputAdvancedProps,
            NumberInputAdvancedProps,
            UploadInputExtensions,
            UploadInputSize,
        },
        data() {
            return {
                labelPosition: 'top',
                fieldProperties: {},
                rules: {},
                advancedPropsVisible: false,
                dialogRules: {
                    dataUrl: [
                        {required: true, message: 'Please input url', trigger: 'change'}
                    ]
                },
            }
        },
        methods: {
            deleteOption(option, index) {
                this.$delete(option, index)
            },
            addOption(option) {
                let count = option.length + 1;
                option.push({
                    optionLabel: "Option Label " + count,
                    optionValue: "Option " + count
                })
            },
            addItem(item) {
                item.push({
                    url: ''
                });
            },
            deleteColumn(column, index, prop) {
                this.$delete(column, index)
                this.activeField.tableDatas.forEach(function (ele) {
                    delete ele[prop];
                })
            },
            addColumn(tableColumns) {
                tableColumns.push({
                    prop: '',
                    label: '',
                    width: 180
                });
            },
            columnWidth(value) {
                if (value && isNaN(value)) {
                    this.$message.error('Column width should be a number!');
                }
            }
        },
        computed: {
            recaptchaSiteKey: {
                get() {
                    if (this.activeField.recaptchaSiteKey !== "") {
                        return this.activeField.recaptchaSiteKey;
                    }

                    return this.options.recaptcha.sitekey;
                },
                set (newValue) {
                    this.activeField.recaptchaSiteKey = newValue;
                }
            },
            recaptchaSiteSecret: {
                get() {
                    if (this.activeField.recaptchaSiteSecret !== "") {
                        return this.activeField.recaptchaSiteSecret;
                    }

                    return this.options.recaptcha.secret;
                },
                set (newValue) {
                    this.activeField.recaptchaSiteSecret = newValue;
                }
            },
            ...mapGetters('laravel_form_builder_datastore', {
                activeField: 'activeField',
            })
        }
    }
</script>

<style scoped>
    .properties__optionslist {
        margin-bottom: 5px;
        list-style: none;
        list-style-type: none;
    }

    .properties__optionsul {
        padding: 0;
    }
</style>
