<template>
  <div class="lnfb-flex lnfb-justify-center">
    <LnfbBasicButton type="button">
      {{ currentField.buttonText }}
    </LnfbBasicButton>
  </div>
</template>

<script>
export default {
  props: ['currentField']
}
</script>
