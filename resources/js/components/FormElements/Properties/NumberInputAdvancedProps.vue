<template>
  <div class="lnfb-space-y-3">
    <div>
      <lnfb-input-number
        :label="__('decimals_count')"
        v-model="activeField.decimals"
        :min="0"
        :max="2"
      />
    </div>
    <div>
      <lnfb-toggle :label="__('has_min_value')" v-model="activeField.hasMinValue" />
    </div>
    <div>
      <div v-if="activeField.hasMinValue">
        <lnfb-input-number :label="__('min_value')" v-model="activeField.min" />
      </div>
    </div>
    <div>
      <lnfb-toggle :label="__('has_max_value')" v-model="activeField.hasMaxValue" />
    </div>
    <div>
      <div v-if="activeField.hasMaxValue">
        <lnfb-input-number :label="__('max_value')" v-model="activeField.max" />
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex';

export default {
  name: 'NumberInputAdvancesProps',
  computed: {
    ...mapGetters('laravel_form_builder_datastore', {
      activeField: 'activeField',
    }),
    stepValue() {
      if (this.activeField.decimals === 0) {
        return '1';
      }

      if (this.activeField.decimals === 1) {
        return '0.1';
      }

      return '0.01';
    },
  },
};
</script>
