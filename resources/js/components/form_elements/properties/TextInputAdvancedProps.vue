<template>
    <div>
        <div class="lnfb-w-full lnfb-px-3 lnfb-mb-3 lnfb-flex">
            <div class="lnfb-w-1/2 lnfb-pr-2">
                <lnfb-input :label="__('prepend_label')"
                                   v-model="activeField.prepend" />

            </div>
            <div class="lnfb-w-1/2 lnfb-pl-2">
                <lnfb-input :label="__('append_label')"
                                   v-model="activeField.append" />
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
    name: 'TextInputAdvancedProps',
    computed: {
        ...mapGetters('laravel_form_builder_datastore', {
            activeField: 'activeField',
        })
    }
}
</script>
