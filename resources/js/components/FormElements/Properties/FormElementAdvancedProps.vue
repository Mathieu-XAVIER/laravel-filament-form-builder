<template>
  <div class="lnfb-space-y-3">
    <div v-if="activeField.hasOwnProperty('name')">
      <lnfb-input :label="__('field_name_label')"
                  v-model="activeField.name"/>
    </div>
    <div v-if="activeField.hasOwnProperty('validationFieldName')"
    >
      <lnfb-input :label="__('field_validation_name')"
                  v-model="activeField.validationFieldName"/>
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  name: 'FormElementAdvancedProps',
  computed: {
    ...mapGetters('laravel_form_builder_datastore', {
      activeField: 'activeField',
    })
  }
}
</script>
