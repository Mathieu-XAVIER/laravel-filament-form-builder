<template>
    <div>
        <div class="w-full px-3 mb-3 flex">
            <div class="w-1/2 pr-2">
                <label class="block text-80 text-sm mb-2">
                    {{ __('prepend_label') }}
                </label>
                <el-input v-model="activeField.prepend"></el-input>
            </div>
            <div class="w-1/2 pl-2">
                <label class="block text-80 text-sm mb-2">
                    {{ __('append_label') }}
                </label>
                <el-input v-model="activeField.append"></el-input>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'

    export default {
        name: 'TextInputAdvancedProps',
        computed: {
            ...mapGetters('laravel_form_builder_datastore', {
                activeField: 'activeField',
            })
        }
    }
</script>
