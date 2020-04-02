<?php

return [
    /**
     * How many fields to display on index view (response preview column) ?
     */
    'index_responses_summary_limit_fields' => 5,

    /**
     * Matching "field_type" (from json config) => Field Class
     */
    'fields_type_matching' => [
        'Button' => \Novius\LaravelFormBuilder\Classes\Fields\Button::class,
        'Checkbox' => \Novius\LaravelFormBuilder\Classes\Fields\CheckboxInput::class,
        'Consent' => \Novius\LaravelFormBuilder\Classes\Fields\ConsentInput::class,
        'GoogleRecaptcha' => \Novius\LaravelFormBuilder\Classes\Fields\GoogleRecaptcha::class,
        'HtmlComponent' => \Novius\LaravelFormBuilder\Classes\Fields\CustomHtml::class,
        'LongTextInput' => \Novius\LaravelFormBuilder\Classes\Fields\LongTextInput::class,
        'NumberInput' => \Novius\LaravelFormBuilder\Classes\Fields\NumberInput::class,
        'Radio' => \Novius\LaravelFormBuilder\Classes\Fields\RadioInput::class,
        'SelectList' => \Novius\LaravelFormBuilder\Classes\Fields\SelectList::class,
        'TextInput' => \Novius\LaravelFormBuilder\Classes\Fields\TextInput::class,
        'Upload' => \Novius\LaravelFormBuilder\Classes\Fields\UploadInput::class,
    ],
];
