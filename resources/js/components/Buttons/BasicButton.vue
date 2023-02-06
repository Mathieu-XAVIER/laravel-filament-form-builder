<template>
  <BasicButton
    v-bind="{ ...$props, ...$attrs }"
    :component="component"
    ref="button"
    class="lnfb-shadow lnfb-relative lnfb-border lnfb-border-gray-300 lnfb-bg-white lnfb-text-gray-700 hover:lnfb-bg-gray-50 focus:lnfb-outline-none"
  >
    <slot/>
  </BasicButton>
</template>

<script>
export default {
  props: {
    size: {
      type: String,
      default: 'lg',
    },

    align: {
      type: String,
      default: 'center',
      validator: v => ['left', 'center'].includes(v),
    },

    component: {
      type: String,
      default: 'button',
    },
  },
}
</script>
