export default {
  namespaced: true,
  state: {
    forms: [],
    activeField: {},
    activeTabForFields: 'elements',
  },
  getters: {
    forms: state => state.forms,
    activeField: state => state.activeField,
    activeTabForFields: state => state.activeTabForFields,
  },
  mutations: {
    activeField(state, value) {
      state.activeField = value
    },
    activeTabForFields(state, value) {
      state.activeTabForFields = value
    },
    forms(state, value) {
      state.forms = value
    },
  },
}
