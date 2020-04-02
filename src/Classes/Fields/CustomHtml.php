<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

class CustomHtml extends AbstractField
{
    public static $model = \Novius\LaravelForm\Classes\Fields\CustomHtml::class;

    /**
     * {@inheritdoc}
     */
    public function position(): int
    {
        return 8;
    }

    /**
     * {@inheritdoc}
     */
    public function params(): array
    {
        return array_merge((static::newModel())->defaultParams(), [
            'text' => trans('laravel-form-builder::fields.html_field_name'),
            'group' => 'static',
            'isUnique' => false,
        ]);
    }
}
