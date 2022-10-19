<template>
    <div class="el-tabs__inner">
        <div class="flex flex-wrap">
            <div v-for="field in fields" class="lnfb-px-1 lnfb-mb-2 lnfb-w-1/2 field-element"
                 :class="{'is-disabled': checkStopDragCondition(field)}"
            >
                <el-button class="button__sidebar"
                           draggable="true"
                           @dragstart="startDrag($event, field)"
                           @dragend="endDrag($event)"
                >
                    {{ field.text }}
                </el-button>
            </div>
        </div>
    </div>
</template>

<script>
    import { v4 as uuidv4 } from 'uuid';
    import { mapGetters } from 'vuex'

    export default {
        name: 'Elements',
        props: [
            'fields',
            'dropElementOptions',
        ],
        methods: {
            startDrag(evt, field) {
                evt.target.classList.add("sortable__ghost");
                evt.dataTransfer.dropEffect = 'move';
                evt.dataTransfer.effectAllowed = 'move';
                evt.dataTransfer.setData('fieldType', field.fieldType)

                console.log("start drag", evt)
            },
            endDrag(event) {
                event.target.classList.remove("sortable__ghost");
            },
            clone(field) {
                const clonedField = _.cloneDeep(field);
                if (clonedField.hasOwnProperty('name')) {
                    clonedField.name = uuidv4();
                }

                return clonedField;
            },
            checkStopDragCondition(field) {
                if (!field.isUnique) {
                    return false;
                }

                let form = this.forms,
                    formArray = [];

                form.forEach(function (section, sectionKey) {
                    section.fields.forEach(function (field, key) {
                        formArray.push(field['fieldType'])
                    });
                });

                return _.includes(formArray, field.fieldType) && field.isUnique;
            },
            checkMove (evt){
                return ! this.checkStopDragCondition(evt.draggedContext.element);
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
        }
    }
</script>

<style scoped>
    .button__sidebar {
        width: 100%;
        margin-bottom: 5px;
        padding: .5rem 1rem;
    }

    .button__sidebar.is-disabled {
        opacity: .4;
        cursor: not-allowed;
    }

    /* Display this ghost in <main> only*/

    .sortable__ghost {
        position: relative;
        width: 33.33%;
        border-bottom: 2px solid #3A8EE6;
        margin-top: 2px;
        margin-bottom: 2px;
    }


    .el-tabs__inner .sortable__ghost {
        display: none;
    }

    .sortable__ghost::before {
        content: "Drag it here";
        background-color: #ECF5FF;
        color: #3A8EE6;
        position: absolute;
        left: 50%;
        font-size: 10px;
        border-radius: 10px;
        line-height: 15px;
        padding: 0 10px;
        top: -6px;
        transform: translateX(-50%);
    }
</style>
