<template>
<el-form-item :label="currentField.label" :label-width="currentField.labelWidth + 'px'">
  <el-radio v-model="radio" v-for="item in currentField.options"
            :key="item.optionValue"
            :label="item.optionLabel" :disabled="item.disabled">
  </el-radio>
  <div v-if="currentField.help"
       v-text="currentField.help"
       class="py-2 text-sm"></div>
</el-form-item>
</template>

<script>
export default {
  name: 'Radio',
  props: ['currentField'],
  data() {
    return {
      radio: '1'
    }
  },
  mounted() {

  }
}
</script>
