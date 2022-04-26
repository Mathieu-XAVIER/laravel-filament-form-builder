import Element from 'element-plus'
import locale from 'element-plus/lib/locale/lang/en'
import datastore from '@/store'
import TextInput from '@/components/form_elements/FormElementTextInput'
import LongTextInput from '@/components/form_elements/FormElementLongTextInput'
import NumberInput from '@/components/form_elements/FormElementNumberInput'
import SelectList from '@/components/form_elements/FormElementSelectList'
import Radio from '@/components/form_elements/FormElementRadio'
import Checkbox from '@/components/form_elements/FormElementCheckbox'
import Consent from '@/components/form_elements/FormElementConsent'
import GoogleRecaptcha from '@/components/form_elements/FormElementGoogleRecaptcha'
import Button from '@/components/form_elements/FormElementButton'
import Upload from '@/components/form_elements/FormElementUpload'
import HtmlComponent from '@/components/form_elements/FormElementHtml'

Nova.booting((Vue, router, store) => {

    Vue.use(Element, {locale})

    Vue.component('TextInput', TextInput)
    Vue.component('LongTextInput', LongTextInput)
    Vue.component('NumberInput', NumberInput)
    Vue.component('SelectList', SelectList)
    Vue.component('Radio', Radio)
    Vue.component('Checkbox', Checkbox)
    Vue.component('Consent', Consent)
    Vue.component('Button', Button)
    Vue.component('Upload', Upload)
    Vue.component('HtmlComponent', HtmlComponent)
    Vue.component('GoogleRecaptcha', GoogleRecaptcha)

  /* store.registerModule(
        'laravel_form_builder_datastore', datastore
    );*/
    Nova.inertia('laravelFormBuilder', require('./components/Tool').default)
})
