<template>
  <div class="v-full">
    <div class="w-full">
      <label class="max-w-xs w-full py-6 px-3 flex flex-wrap flex-row
            form-input-bordered border border-dashed cursor-pointer">
        <div class="w-full flex items-center justify-center text-black">
          <input type="file"
                 :required="currentField.isRequired"
                 :accept="extensions"
                 class="cursor-pointer relative block hidden">
          <svg class="w-6 h-6 mr-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path
              d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"/>
          </svg>
          <span class="text-sm leading-none  font-bold uppercase" v-text="currentField.label"></span>
        </div>

        <div class="w-full py-2 text-sm text-black text-center">
          <span v-if="currentField.help" v-text="currentField.help"></span>
          (<span v-text="sizeMo"></span> mb)
        </div>
      </label>

    </div>
  </div>
</template>
<script>
export default {
  name: 'Upload',
  props: ['currentField'],
  data: () => ({}),

  computed: {
    extensions() {
      return _.join(_.map(this.currentField.extensions, (extension) => {
        return `.${extension}`
      }), ',');
    },
    sizeMo() {
      return _.round(this.currentField.maxSize / 1000, 2);
    },
  },
}
</script>

<style>
input:invalid + svg,
input:invalid + svg + span {
  color: red;
}
</style>
