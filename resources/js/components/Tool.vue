<template>
  <div>
    <Heading class="mb-2">
      {{ __('form') }}&nbsp;:&nbsp;<span v-text="formName"></span>
    </Heading>

    <div class="lnfb-mb-2">
      <Link class="text-primary-500 lnfb-inline-flex lnfb-items-center"
            :href="$url(`/resources/forms/${this.form.id}`)"
      >
        <svg class="lnfb-h-4 lnfb-w-4 lnfb-fill-current lnfb-mr-1" viewBox="0 0 20 20">
          <path
            d="M11.739,13.962c-0.087,0.086-0.199,0.131-0.312,0.131c-0.112,0-0.226-0.045-0.312-0.131l-3.738-3.736c-0.173-0.173-0.173-0.454,0-0.626l3.559-3.562c0.173-0.175,0.454-0.173,0.626,0c0.173,0.172,0.173,0.451,0,0.624l-3.248,3.25l3.425,3.426C11.911,13.511,11.911,13.789,11.739,13.962 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.148,3.374,7.521,7.521,7.521C14.147,17.521,17.521,14.148,17.521,10"></path>
        </svg>
        <span>
          {{ __('back_to_form_edition') }}
        </span>
      </Link>
    </div>

    <Home :fields="fields"/>

    <div
      class="lnfb-flex lnfb-flex-col md:lnfb-flex-row md:lnfb-items-center lnfb-justify-center md:lnfb-justify-end lnfb-space-y-2 md:lnfb-space-y-0 lnfb-space-x-3"
    >
      <Button
        dusk="cancel-update-button"
        variant="ghost"
        :label="__('Cancel')"
        @click="cancelUpdatingForm"
      />

      <Button
        @click="save"
        align="center"
      >
        {{ __('Update & Continue Editing') }}
      </Button>
    </div>
  </div>
</template>

<script>
import Home from '../views/Home';
import { v4 as uuidv4 } from 'uuid';
import { mapGetters } from "vuex";
import { Button } from 'laravel-nova-ui'

export default {
  components: {
    Button,
    Home,
  },
  props: {
    form: Object,
  },
  mounted() {
    const component = this;

    Nova.request({
      url: '/nova-vendor/laravel-form-builder/form-fields/' + this.form.id,
      method: 'GET',
    }).then(({ data }) => {
      if (data.error) {
        Nova.error(data.message)
      } else {
        component.init = true;
        component.formName = data.formName;
        component.fields = data.defaultFields;
        if (data.fields) {
          const formFields = data.fields;
          formFields.forEach(function (section, sectionKey) {
            section.fields.forEach(function (field, key) {
              if (field.group === 'form' && (!field.name || field.name === '')) {
                field.name = uuidv4();
                formFields[sectionKey]['fields'][key] = field;
              }
            });
          });
          component.forms = formFields;
        }
      }
    }).catch((error) => {
      console.error(error);
      Nova.error('Unexpected error.');
    });
  },
  data() {
    return {
      init: false,
      loading: false,
      formName: '',
      fields: [],
    }
  },
  computed: {
    ...mapGetters('laravel_form_builder_datastore', {
      formsFromStore: 'forms',
    }),
    forms: {
      get() {
        return this.formsFromStore
      },
      set(value) {
        return this.$store.commit('laravel_form_builder_datastore/forms', value)
      }
    },
  },
  methods: {
    save() {
      const component = this;

      Nova.request({
        url: '/nova-vendor/laravel-form-builder/save-fields/' + this.form.id,
        method: 'POST',
        data: {
          fields: JSON.stringify(component.forms),
        }
      }).then(({ data }) => {
        if (data.error) {
          Nova.error(data.message)
        } else {
          Nova.success(data.message)
        }
      }).catch((error) => {
        console.error(error);
        Nova.error('Unexpected error')
      });
    },

    cancelUpdatingForm() {
      Nova.visit(`/resources/forms/${this.form.id}`)
    }
  }
}
</script>
