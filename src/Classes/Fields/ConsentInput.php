<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

class ConsentInput extends AbstractField
{
    public static $model = \Novius\LaravelForm\Classes\Fields\ConsentInput::class;

    /**
     * {@inheritdoc}
     */
    public function position(): int
    {
        return 9;
    }

    /**
     * {@inheritdoc}
     */
    public function params(): array
    {
        return array_merge((static::newModel())->defaultParams(), [
            'text' => trans('laravel-form-builder::fields.consent_field_name'),
            'isUnique' => false,
            'advancedOptions' => true,
        ]);
    }
}
