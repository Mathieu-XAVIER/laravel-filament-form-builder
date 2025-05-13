<template>
  <Button
    v-bind="{ ...$props, ...$attrs }"
    :component="component"
    ref="button"
    class="lnfb-rounded-md lnfb-bg-indigo-600 lnfb-px-3.5 lnfb-py-2.5 lnfb-text-sm lnfb-font-semibold lnfb-text-white lnfb-shadow-xs hover:lnfb-bg-indigo-500 focus-visible:lnfb-outline-2 focus-visible:lnfb-outline-offset-2 focus-visible:lnfb-outline-indigo-600"
  >
    <slot />
  </Button>
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
      validator: (v) => ['left', 'center'].includes(v),
    },

    component: {
      type: String,
      default: 'button',
    },
  },
};
</script>
