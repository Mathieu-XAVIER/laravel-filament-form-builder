import ElementPlus from 'element-plus'
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
import Tool from '@/components/Tool'

Nova.booting((app, store) => {

  console.log(app);

  app.use(ElementPlus)
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

  store.registerModule(
    'laravel_form_builder_datastore', datastore
  );

  Nova.inertia('LaravelFormBuilder', Tool)
});
