<template>
  <div class="el-tabs__inner">
    <form @submit.prevent.stop>
      <div class="w-full flex flex-wrap">
        <div class="w-full px-3 mb-3" v-show="activeField.hasOwnProperty('col')">
          <lnfb-input-number
            :label="__('field_width')"
            v-model.number="activeField.col"
            :min="1"
            :max="3"
          />
        </div>
        <div class="w-full px-3 mb-3" v-if="activeField.fieldType === 'LongTextInput'">
          <lnfb-input-number
            :label="__('number_of_rows')"
            v-model="activeField.rows"
            :min="1"
            :max="30"
          />
        </div>
        <div class="w-full px-3 mb-3" v-show="activeField.hasOwnProperty('label')">
          <lnfb-input :label="__('field_label')" v-model="activeField.label" />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.isPlaceholderVisible">
          <lnfb-input :label="__('placeholder')" v-model="activeField.placeholder" />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.fieldType === 'TextInput'">
          <lnfb-select
            :label="__('input_type')"
            v-model="activeField.inputType"
            :options="inputTypes"
          />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.hasOwnProperty('maxlength')">
          <lnfb-input-number
            :label="__('chars_limit')"
            v-model.number="activeField.maxlength"
            :min="1"
          />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.isHelpBlockVisible">
          <lnfb-input :label="__('help_label')" v-model="activeField.help" />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.hasOwnProperty('consentText')">
          <lnfb-textarea :label="__('consent_label')" :rows="3" v-model="activeField.consentText" />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.hasOwnProperty('isRequired')">
          <lnfb-toggle :label="__('is_required_field')" v-model="activeField.isRequired" />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.hasOwnProperty('multiple')">
          <lnfb-toggle :label="__('is_multiple_field')" v-model="activeField.multiple" />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.hasOwnProperty('maxSize')">
          <label class="block text-80 text-sm mb-2">
            {{ __('file_max_size') }}
          </label>
          <upload-input-size></upload-input-size>
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.hasOwnProperty('extensions')">
          <label class="block text-80 text-sm mb-2">
            {{ __('allowed_extensions') }}
          </label>
          <upload-input-extensions></upload-input-extensions>
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.hasOwnProperty('recaptchaSiteKey')">
          <lnfb-input :label="__('recaptcha_site_key')" v-model="activeField.recaptchaSiteKey" />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.hasOwnProperty('recaptchaSiteSecret')">
          <lnfb-input
            :label="__('recaptcha_site_secret')"
            v-model="activeField.recaptchaSiteSecret"
          />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.hasOwnProperty('honeypotFieldName')">
          <lnfb-input :label="__('honeypot_field_name')" v-model="activeField.honeypotFieldName" />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.hasOwnProperty('honeypotFieldLabel')">
          <lnfb-input
            :label="__('honeypot_field_label')"
            v-model="activeField.honeypotFieldLabel"
          />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.hasOwnProperty('buttonText')">
          <lnfb-input :label="__('button_text_label')" v-model="activeField.buttonText" />
        </div>

        <div class="w-full px-3 mb-3" v-if="activeField.options">
          <label class="block text-80 text-sm mb-2">
            {{ __('item_options') }}
          </label>
          <div class="lnfb-py-2">
            <ul>
              <li class="properties__optionslist lnfb-flex">
                <div class="lnfb-w-2/5 lnfb-text-xs lnfb-text-center">
                  {{ __('option_label') }}
                </div>
                <div class="lnfb-w-2/5 lnfb-text-xs lnfb-text-center">
                  {{ __('option_value') }}
                </div>
                <div class="w-1/5 text-xs"></div>
              </li>
              <li v-for="(item, index) in activeField.options" :key="index" class="lnfb-mb-1">
                <div class="flex">
                  <div class="lnfb-w-2/5 lnfb-pr-2 lnfb-text-xs">
                    <lnfb-input v-model="item.optionLabel" />
                  </div>
                  <div class="lnfb-w-2/5 lnfb-pr-2 lnfb-text-xs">
                    <lnfb-input v-model="item.optionValue" />
                  </div>
                  <div class="lnfb-w-1/5 lnfb-flex lnfb-flex-col lnfb-justify-center">
                    <button
                      type="button"
                      class="lnfb-text-red-500"
                      @click="deleteOption(index)"
                      v-show="activeField.options.length > 1"
                    >
                      <svg class="lnfb-fill-current lnfb-w-4 lnfb-h-4" viewBox="0 0 20 20">
                        <path
                          d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"
                        ></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </li>
            </ul>
            <LnfbBasicButton size="xs" @click="addOption(activeField.options)">
              <i class="el-icon-plus"></i>
              {{ __('add_more') }}
            </LnfbBasicButton>
          </div>
        </div>
        <div class="w-full px-3 mb-3" v-if="activeField.hasOwnProperty('htmlContent')">
          <lnfb-textarea
            :label="__('html_content_label')"
            :rows="10"
            v-model="activeField.htmlContent"
          />
        </div>
        <div class="w-full px-3 mb-3">
          <LnfbBasicButton
            v-show="activeField.hasOwnProperty('advancedOptions') || activeField.group === 'form'"
            @click="advancedPropsVisible = true"
            size="sm"
          >
            {{ __('advanced_options') }}
          </LnfbBasicButton>
        </div>
      </div>
    </form>

    <Modal :show="advancedPropsVisible" size="lg" tabindex="-1" role="dialog">
      <form
        ref="theForm"
        autocomplete="off"
        @submit.prevent.stop="$emit('confirm')"
        class="lnfb-bg-white dark:lnfb-bg-gray-800 lnfb-rounded-lg lnfb-shadow-lg lnfb-overflow-hidden lnfb-space-y-6"
      >
        <div class="lnfb-space-y-6">
          <ModalHeader> Propriétés </ModalHeader>
          <ModalContent class="lnfb-space-y-3">
            <form-element-advanced-props></form-element-advanced-props>

            <text-input-advanced-props
              v-if="activeField.fieldType === 'TextInput'"
            ></text-input-advanced-props>

            <number-input-advanced-props
              v-if="activeField.fieldType === 'NumberInput'"
            ></number-input-advanced-props>
          </ModalContent>
        </div>

        <ModalFooter>
          <div class="ml-auto">
            <LinkButton type="button" @click.prevent="advancedPropsVisible = !advancedPropsVisible">
              Fermer
            </LinkButton>
          </div>
        </ModalFooter>
      </form>
    </Modal>
  </div>
</template>

<script>
import FormElementAdvancedProps from './FormElements/Properties/FormElementAdvancedProps';
import TextInputAdvancedProps from './FormElements/Properties/TextInputAdvancedProps.vue';
import NumberInputAdvancedProps from './FormElements/Properties/NumberInputAdvancedProps.vue';
import UploadInputExtensions from './FormElements/Properties/UploadInputExtensions.vue';
import UploadInputSize from './FormElements/Properties/UploadInputSize.vue';
import { mapGetters } from 'vuex';
import { Localization } from 'laravel-nova';

export default {
  name: 'Properties',
  props: ['options'],
  mixins: [Localization],
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
      inputTypes: [
        { name: this.__('field_type_text'), value: 'text' },
        { name: this.__('field_type_email'), value: 'email' },
        { name: this.__('field_type_phone'), value: 'phone' },
        { name: this.__('field_type_password'), value: 'password' },
      ],
    };
  },
  methods: {
    deleteOption(optionIndex) {
      let options = this.activeField.options;
      options.splice(optionIndex, 1);

      this.activeField.options = options;
    },
    addOption(option) {
      let count = option.length + 1;
      option.push({
        optionLabel: 'Option Label ' + count,
        optionValue: 'Option ' + count,
      });
    },
  },
  computed: {
    recaptchaSiteKey: {
      get() {
        if (this.activeField.recaptchaSiteKey !== '') {
          return this.activeField.recaptchaSiteKey;
        }

        return this.options.recaptcha.sitekey;
      },
      set(newValue) {
        this.activeField.recaptchaSiteKey = newValue;
      },
    },
    recaptchaSiteSecret: {
      get() {
        if (this.activeField.recaptchaSiteSecret !== '') {
          return this.activeField.recaptchaSiteSecret;
        }

        return this.options.recaptcha.secret;
      },
      set(newValue) {
        this.activeField.recaptchaSiteSecret = newValue;
      },
    },
    ...mapGetters('laravel_form_builder_datastore', {
      activeField: 'activeField',
    }),
  },
};
</script>
