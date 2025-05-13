<template>
  <div>
    <div class="mb-2" v-for="extensionDetails in availableExtensions">
      <div class="text-bold uppercase leading-tight" v-text="extensionDetails.type"></div>
      <div class="flex flex-wrap">
        <label class="mr-4 mb-2 leading-tight" v-for="extension in extensionDetails.extensions">
          <input
            v-model="activeField.extensions"
            :value="extension"
            class="mr-1 leading-tight"
            type="checkbox"
          />
          <span class="text-sm" v-text="extension"></span>
        </label>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex';

export default {
  name: 'UploadInputExtensions',
  data() {
    return {
      name: '',
      checkedExtensions: '',
      availableExtensions: {
        images: {
          type: 'Images',
          extensions: ['jpg', 'jpeg', 'gif', 'png', 'svg'],
        },
        files: {
          type: 'Fichiers',
          extensions: ['doc', 'docx', 'odt', 'pdf'],
        },
        presentations: {
          type: 'Présentations',
          extensions: ['pps', 'ppt', 'pptx'],
        },
        spreadsheets: {
          type: 'Feuilles',
          extensions: ['ods', 'xls', 'xlsx'],
        },
        others: {
          type: 'Autres',
          extensions: ['psd'],
        },
      },
    };
  },
  computed: {
    ...mapGetters('laravel_form_builder_datastore', {
      activeField: 'activeField',
    }),
  },
};
</script>
