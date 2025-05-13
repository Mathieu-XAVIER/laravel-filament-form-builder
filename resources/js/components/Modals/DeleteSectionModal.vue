<template>
  <Modal :show="show" role="alertdialog" size="sm">
    <form
      @submit.prevent="handleConfirm"
      class="lnfb-mx-auto lnfb-bg-white dark:lnfb-bg-gray-800 lnfb-rounded-lg lnfb-shadow-lg lnfb-overflow-hidden"
    >
      <slot>
        <ModalHeader> Suppression </ModalHeader>
        <ModalContent>
          <p class="lnfb-leading-normal">Êtes-vous sûr de vouloir supprimer cette section ?</p>
        </ModalContent>
      </slot>

      <ModalFooter>
        <div class="ml-auto">
          <LinkButton type="button" @click.prevent="handleClose" className="mr-3">
            {{ __('Cancel') }}
          </LinkButton>

          <LnfbDangerButton type="submit"> Supprimer </LnfbDangerButton>
        </div>
      </ModalFooter>
    </form>
  </Modal>
</template>

<script>
export default {
  emits: ['confirm', 'close'],

  props: {
    show: { type: Boolean, default: false },
  },

  data: () => ({
    working: false,
  }),

  methods: {
    handleClose() {
      this.$emit('close');
      this.working = false;
    },

    handleConfirm() {
      this.$emit('confirm');
      this.working = true;
    },
  },
};
</script>
