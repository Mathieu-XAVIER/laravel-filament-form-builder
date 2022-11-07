<template>
  <Modal
    :show="show"
    role="alertdialog"
    size="sm"
  >
    <form
      @submit.prevent="handleConfirm"
      class="lnfb-mx-auto lnfb-bg-white dark:lnfb-bg-gray-800 lnfb-rounded-lg lnfb-shadow-lg lnfb-overflow-hidden"
    >
      <slot>
        <ModalHeader>
            Suppression
        </ModalHeader>
        <ModalContent>
          <p class="lnfb-leading-normal">
            Êtes-vous sûr de vouloir supprimer le champ "<span v-text="field.label"></span>" ?
          </p>
        </ModalContent>
      </slot>

      <ModalFooter>
        <div class="ml-auto">
          <LinkButton
            type="button"
            @click.prevent="handleClose"
            class="mr-3"
          >
            {{ __('Cancel') }}
          </LinkButton>

          <LnfbDangerButton
              type="submit"
          >
              Supprimer
          </LnfbDangerButton>

        </div>
      </ModalFooter>
    </form>
  </Modal>
</template>

<script>
import startCase from 'lodash/startCase'

export default {
  emits: ['confirm', 'close'],

  props: {
    show: { type: Boolean, default: false },

    field: { type: Object, required: true },
  },

  data: () => ({
    working: false,
  }),

  methods: {
    handleClose() {
      this.$emit('close')
      this.working = false
    },

    handleConfirm() {
      this.$emit('confirm')
      this.working = true
    },
  },

  /**
   * Mount the component.
   */
  mounted() {
    this.$nextTick(() => {
      // this.$refs.confirmButton.button.focus()
    })
  },
}
</script>
