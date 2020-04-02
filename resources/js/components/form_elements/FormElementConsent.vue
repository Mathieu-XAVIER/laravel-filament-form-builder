<template>
    <div class="flex mb-6">
        <label class="flex items-start content-start justify-start">
            <input :required="currentField.isRequired"
                   type="checkbox"
                   class="leading-tight mt-1"
                   :value="currentField.value">
            <span class="consent-text ml-4 leading-tight">{{ currentField.consentText }}</span>
        </label>
    </div>
</template>

<script>
export default {
  name: 'Consent',
  props: ['currentField'],
}
</script>

<style>
    .consent-text {
        white-space: pre-line;
    }
</style>
