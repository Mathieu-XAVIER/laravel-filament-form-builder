<template>
    <div class="flex justify-center">
        <button type="button"
                class="btn btn-default btn-primary inline-flex items-center relative">
            {{ currentField.buttonText }}
        </button>
    </div>
</template>

<script>
  export default {
    name: 'Button',
    props: ['currentField']
  }
</script>
