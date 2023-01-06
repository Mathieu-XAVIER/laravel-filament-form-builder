<template>
  <BasicButton
    v-bind="{ ...$props, ...$attrs }"
    :component="component"
    ref="button"
    class="lnfb-shadow lnfb-relative lnfb-bg-red-500 hover:lnfb-bg-red-400 lnfb-text-white"
  >
    <slot />
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
