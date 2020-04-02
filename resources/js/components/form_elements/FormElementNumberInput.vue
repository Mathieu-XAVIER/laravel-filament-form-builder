<template>
    <div class="w-full">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
               v-text="currentField.label">
        </label>

        <el-input-number controls-position="right"
                         v-bind="attributesBinding">
        </el-input-number>

        <div v-if="currentField.help"
             v-text="currentField.help"
             class="py-2 text-sm"></div>
    </div>
</template>

<script>
    export default {
        name: 'NumberInput',
        props: ['currentField'],
        computed: {
            attributesBinding() {
                var attr = {};
                attr.placeholder = this.currentField.placeholder;

                if (this.currentField.hasMinValue) {
                    attr.min = this.currentField.min;
                }
                if (this.currentField.hasMaxValue) {
                    attr.max = this.currentField.max;
                }

                return attr;
            }
        }
    }
</script>
