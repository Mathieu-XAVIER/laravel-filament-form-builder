<template>
    <div>
        <div class="w-full px-3 mb-3">
            <label class="block text-80 text-sm mb-2">
                {{ __('decimals_count') }}
            </label>
            <el-input-number v-model="activeField.decimals"
                             controls-position="right"
                             :min="0"
                             :max="2">
            </el-input-number>
        </div>
        <div class="w-full px-3 mb-3 flex">
            <div class="w-1/6 pr-2">
                <label class="block text-80 text-sm mb-2">
                    {{ __('has_min_value') }}
                </label>
                <el-switch v-model="activeField.hasMinValue"></el-switch>
            </div>
            <div class="w-1/3 pr-2">
                <div v-if="activeField.hasMinValue">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('min_value') }}
                    </label>
                    <el-input-number v-model="activeField.min"
                                     controls-position="right"
                                     size="small"></el-input-number>
                </div>
            </div>
            <div class="w-1/6 pr-2">
                <label class="block text-80 text-sm mb-2">
                    {{ __('has_max_value') }}
                </label>
                <el-switch v-model="activeField.hasMaxValue"></el-switch>
            </div>
            <div class="w-1/3">
                <div v-if="activeField.hasMaxValue">
                    <label class="block text-80 text-sm mb-2">
                        {{ __('max_value') }}
                    </label>
                    <el-input-number  v-model="activeField.max"
                                      controls-position="right"
                                      size="small"></el-input-number>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'

    export default {
        name: 'NumberInputAdvancesProps',
        computed: {
            ...mapGetters('laravel_form_builder_datastore', {
                activeField: 'activeField'
            }),
            stepValue() {
                if (this.activeField.decimals === 0) {
                    return '1';
                }

                if (this.activeField.decimals === 1) {
                    return '0.1';
                }

                return '0.01';
            },
        }
    }
</script>
