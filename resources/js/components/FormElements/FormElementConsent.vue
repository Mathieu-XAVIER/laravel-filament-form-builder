<template>
  <div class="lnfb-relative lnfb-flex items-start">
    <div class="lnfb-flex lnfb-h-5 lnfb-items-center">
      <input type="checkbox"
             class="lnfb-h-4 lnfb-w-4 lnfb-rounded lnfb-border-gray-300 lnfb-text-indigo-600 focus:lnfb-ring-indigo-500"
             :required="currentField.isRequired"/>
    </div>
    <div class="lnfb-ml-3 lnfb-text-sm">
      <label class="lnfb-font-medium lnfb-text-gray-700">{{ currentField.consentText }}</label>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Consent',
  props: ['currentField'],
}
</script>
