<template>
    <div>
        <div class="w-full px-3 mb-3"
             v-if="activeField.hasOwnProperty('name')">
            <label class="block text-80 text-sm mb-2">
                {{ __('field_name_label') }}
            </label>
            <el-input v-model="activeField.name"></el-input>
        </div>

        <div class="w-full px-3 mb-3"
             v-if="activeField.hasOwnProperty('validationFieldName')">
            <label class="block text-80 text-sm mb-2">
                {{ __('field_validation_name') }}
            </label>
            <el-input v-model="activeField.validationFieldName"></el-input>
        </div>
    </div>
</template>
<script>
    import {mapGetters} from 'vuex'

    export default {
        name: 'FormElementAdvancedProps',
        computed: {
            ...mapGetters('laravel_form_builder_datastore', {
                activeField: 'activeField',
            })
        }
    }
</script>
