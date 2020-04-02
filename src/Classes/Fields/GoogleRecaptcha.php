<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

class GoogleRecaptcha extends AbstractField
{
    public static $model = \Novius\LaravelForm\Classes\Fields\GoogleRecaptcha::class;

    /**
     * {@inheritdoc}
     */
    public function position(): int
    {
        return 10;
    }

    /**
     * {@inheritdoc}
     */
    public function params(): array
    {
        return array_merge((static::newModel())->defaultParams(), [
            'text' => trans('laravel-form-builder::fields.recaptcha_field_name'),
            'isUnique' => true,
        ]);
    }
}
