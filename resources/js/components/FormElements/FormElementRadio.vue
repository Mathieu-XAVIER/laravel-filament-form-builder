<template>
  <fieldset class="lnfb-space-y-2">
    <legend class="lnfb-block lnfb-uppercase lnfb-tracking-wide lnfb-text-gray-700 lnfb-text-xs lnfb-font-bold"
            v-text="currentField.label"/>

    <p class="text-sm leading-5 text-gray-500"
       v-if="currentField.help"
       v-text="currentField.help"/>

    <div class="lnfb-relative lnfb-flex lnfb-items-start"
         v-for="item in currentField.options"
         :key="item.optionValue"
    >
      <input :disabled="item.disabled"
             type="radio"
             class="lnfb-h-4 lnfb-w-4 lnfb-border-gray-300 lnfb-text-indigo-600 focus:lnfb-ring-indigo-500"/>

      <label class="lnfb-ml-3 lnfb-block lnfb-text-sm lnfb-font-medium lnfb-text-gray-700"
             v-text="item.optionLabel"/>
    </div>
  </fieldset>
</template>

<script>
export default {
  name: 'Radio',
  props: ['currentField'],
}
</script>
