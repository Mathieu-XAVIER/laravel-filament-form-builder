<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

class Button extends AbstractField
{
    public static $model = \Novius\LaravelForm\Classes\Fields\Button::class;

    /**
     * {@inheritdoc}
     */
    public function position(): int
    {
        return 11;
    }

    /**
     * {@inheritdoc}
     */
    public function params(): array
    {
        return array_merge((static::newModel())->defaultParams(), [
            'text' => trans('laravel-form-builder::fields.button_field_name'),
            'group' => 'button',
            'isUnique' => true,
        ]);
    }
}
