<template>
  <div>
    <lnfb-input-number :label="__('chars_limit')" v-model="activeField.maxSize" :min="500" />

    <div class="text-xs leading-loose">
      <span v-text="activeField.maxSize"></span> KB (<span v-text="sizeMo"></span> Mo)
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex';

export default {
  name: 'UploadInputSize',
  computed: {
    sizeMo: function () {
      return _.round(this.activeField.maxSize / 1000, 2);
    },
    ...mapGetters('laravel_form_builder_datastore', {
      activeField: 'activeField',
    }),
  },
};
</script>
