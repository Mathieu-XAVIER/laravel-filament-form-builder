<template>
    <div>

        <Head title="test" />

        <Heading class="mb-6">
<!--            <router-link
                :to="{
                  name: 'index',
                  params: {
                    resourceName: 'forms',
                  },
                }"
                class="no-underline text-primary font-bold dim"
            >
                &larr;
            </router-link>-->
            {{ __('form') }}&nbsp;:&nbsp;<span v-text="formName"></span>
        </Heading>

        <home :fields="fields" />

        <div class="flex items-center">
            <cancel-button />

            <button
                class="btn btn-default btn-primary inline-flex items-center relative"
                type="button"
                @click="save"
            >
                {{ __('Update & Continue Editing') }}
            </button>
        </div>
    </div>
</template>

<script>
    import Home from '../views/Home';
    import { v4 as uuidv4 } from 'uuid';
    import { mapGetters } from "vuex";

    export default {
        components: {
            Home,
        },
        props: {
            form: Object,
        },
        mounted() {
            const component = this;

            Nova.request({
                url: '/nova-vendor/laravel-form-builder/form-fields/' + this.form.id,
                method: 'GET',
            }).then(({data}) => {
                if (data.error) {
                    this.$toasted.show(data.message, {type: 'error'});
                } else {
                    component.init = true;
                    component.formName = data.formName;
                    component.fields = data.defaultFields;
                    if (data.fields) {
                        const formFields = data.fields;
                        formFields.forEach(function (section, sectionKey) {
                            section.fields.forEach(function (field, key) {
                                if (field.group === 'form' && (!field.name || field.name === '')) {
                                    field.name = uuidv4();
                                    formFields[sectionKey]['fields'][key] = field;
                                }
                            });
                        });
                        component.forms = formFields;
                    }
                }
            }).catch((error) => {
                return this.$router.push({name: '404'})
            });
        },
        data() {
            return {
                init: false,
                loading: false,
                formName: '',
                fields: [],
            }
        },
        computed: {
            ...mapGetters('laravel_form_builder_datastore', {
                formsFromStore: 'forms',
            }),
            forms: {
                get() {
                    return this.formsFromStore
                },
                set(value) {
                    return this.$store.commit('laravel_form_builder_datastore/forms', value)
                }
            },
        },
        methods: {
            save() {
                const component = this;

                Nova.request({
                    url: '/nova-vendor/laravel-form-builder/save-fields/' + this.form.id,
                    method: 'POST',
                    data: {
                        fields: JSON.stringify(component.forms),
                    }
                }).then(({data}) => {
                    if (data.error) {
                        this.$toasted.show(data.message, {type: 'error'});
                    } else {
                        this.$toasted.show(data.message, {type: 'success'})
                    }
                }).catch((error) => {
                    this.$toasted.show('Unexpected error', {type: 'error'});
                });
            },
        }
    }
</script>
