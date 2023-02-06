import datastore from '@/store'
import TextInput from '@/components/FormElements/FormElementTextInput'
import LongTextInput from '@/components/FormElements/FormElementLongTextInput'
import NumberInput from '@/components/FormElements/FormElementNumberInput'
import SelectList from '@/components/FormElements/FormElementSelectList'
import Radio from '@/components/FormElements/FormElementRadio'
import Checkbox from '@/components/FormElements/FormElementCheckbox'
import Consent from '@/components/FormElements/FormElementConsent'
import GoogleRecaptcha from '@/components/FormElements/FormElementGoogleRecaptcha'
import HoneyPot from '@/components/FormElements/FormElementHoneyPot'
import BasicButton from '@/components/Buttons/BasicButton'
import DangerButton from '@/components/Buttons/DangerButton'
import Input from '@/components/Forms/Input'
import Button from '@/components/FormElements/FormElementButton'
import InputNumber from '@/components/Forms/InputNumber'
import Select from '@/components/Forms/Select'
import Textarea from '@/components/Forms/Textarea'
import Toggle from '@/components/Forms/Toggle'
import DeleteFieldModal from '@/components/Modals/DeleteFieldModal'
import DeleteSectionModal from '@/components/Modals/DeleteSectionModal'
import Upload from '@/components/FormElements/FormElementUpload'
import HtmlComponent from '@/components/FormElements/FormElementHtml'
import Tool from '@/components/Tool'

Nova.booting((app, store) => {

  //app.use(ElementPlus)
  app.component('LnfbTextInput', TextInput)
  app.component('LnfbLongTextInput', LongTextInput)
  app.component('LnfbNumberInput', NumberInput)
  app.component('LnfbSelectList', SelectList)
  app.component('LnfbRadio', Radio)
  app.component('LnfbCheckbox', Checkbox)
  app.component('LnfbConsent', Consent)
  app.component('LnfbButton', Button)
  app.component('LnfbUpload', Upload)
  app.component('LnfbHtmlComponent', HtmlComponent)
  app.component('LnfbGoogleRecaptcha', GoogleRecaptcha)
  app.component('LnfbHoneyPot', HoneyPot)
  app.component('LnfbInput', Input)
  app.component('LnfbInputNumber', InputNumber)
  app.component('LnfbSelect', Select)
  app.component('LnfbTextarea', Textarea)
  app.component('LnfbToggle', Toggle)
  app.component('LnfbBasicButton', BasicButton)
  app.component('LnfbDangerButton', DangerButton)
  app.component('LnfbDeleteFieldModal', DeleteFieldModal)
  app.component('LnfbDeleteSectionModal', DeleteSectionModal)

  store.registerModule(
    'laravel_form_builder_datastore', datastore
  );

  Nova.inertia('LaravelFormBuilder', Tool)
});
