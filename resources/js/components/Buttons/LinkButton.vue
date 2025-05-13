<template>
  <button
    :type="type"
    :class="`${className} lnfb-rounded-md lnfb-bg-indigo-600 lnfb-px-3.5 lnfb-py-2.5 lnfb-text-sm lnfb-font-semibold lnfb-text-white lnfb-shadow-xs hover:lnfb-bg-indigo-500 focus-visible:lnfb-outline-2 focus-visible:lnfb-outline-offset-2 focus-visible:lnfb-outline-indigo-600`"
  >
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: 'button',
    },
    className: {
      type: String,
      default: '',
    },
  },
};
</script>
