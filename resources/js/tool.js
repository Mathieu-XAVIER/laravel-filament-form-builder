//import ElementPlus from 'element-plus'
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
import DangerButton from '@/components/Buttons/DangerButton'
import Input from '@/components/Forms/Input'
import InputNumber from '@/components/Forms/InputNumber'
import Select from '@/components/Forms/Select'
import Textarea from '@/components/Forms/Textarea'
import Toggle from '@/components/Forms/Toggle'
import DeleteFieldModal from '@/components/Modals/DeleteFieldModal'
import Upload from '@/components/form_elements/FormElementUpload'
import HtmlComponent from '@/components/form_elements/FormElementHtml'
import Tool from '@/components/Tool'

Nova.booting((app, store) => {

  //app.use(ElementPlus)
  app.component('TextInput', TextInput)
  app.component('LongTextInput', LongTextInput)
  app.component('NumberInput', NumberInput)
  app.component('SelectList', SelectList)
  app.component('Radio', Radio)
  app.component('Checkbox', Checkbox)
  app.component('Consent', Consent)
  //app.component('Button', Button)
  app.component('Upload', Upload)
  app.component('HtmlComponent', HtmlComponent)
  app.component('GoogleRecaptcha', GoogleRecaptcha)

  app.component('LnfbInput', Input)
  app.component('LnfbInputNumber', InputNumber)
  app.component('LnfbSelect', Select)
  app.component('LnfbTextarea', Textarea)
  app.component('LnfbToggle', Toggle)
  app.component('LnfbDangerButton', DangerButton)
  app.component('LnfbDeleteFieldModal', DeleteFieldModal)

  store.registerModule(
    'laravel_form_builder_datastore', datastore
  );

  Nova.inertia('LaravelFormBuilder', Tool)
});
