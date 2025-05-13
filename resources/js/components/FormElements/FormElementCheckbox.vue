<template>
  <fieldset class="lnfb-space-y-2">
    <legend
      class="lnfb-block lnfb-uppercase lnfb-tracking-wide lnfb-text-gray-700 dark:lnfb-text-gray-400 lnfb-text-xs lnfb-font-bold"
      v-text="currentField.label"
    />

    <p
      class="text-sm leading-5 text-gray-500"
      v-if="currentField.help"
      v-text="currentField.help"
    />

    <div
      class="lnfb-relative lnfb-flex lnfb-items-start"
      v-for="item in currentField.options"
      :key="item.optionValue"
    >
      <div class="lnfb-flex lnfb-h-5 lnfb-items-center">
        <input
          type="checkbox"
          class="lnfb-h-4 lnfb-w-4 lnfb-rounded lnfb-border-gray-300 lnfb-text-indigo-600 focus:lnfb-ring-indigo-500"
        />
      </div>
      <div class="lnfb-ml-3 lnfb-text-sm">
        <label
          class="lnfb-font-medium lnfb-text-gray-700 dark:lnfb-text-gray-400"
          v-text="item.optionLabel"
        />
      </div>
    </div>
  </fieldset>
</template>

<script>
export default {
  props: ['currentField'],
};
</script>
