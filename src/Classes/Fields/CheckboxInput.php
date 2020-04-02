<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

class CheckboxInput extends AbstractField
{
    public static $model = \Novius\LaravelForm\Classes\Fields\CheckboxInput::class;

    /**
     * {@inheritdoc}
     */
    public function params(): array
    {
        return array_merge((static::newModel())->defaultParams(), [
            'isHelpBlockVisible' => true,
            'advancedOptions' => true,
            'isUnique' => false,
            'group' => 'form',
            'text' => trans('laravel-form-builder::fields.checkbox_field_name'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function position(): int
    {
        return 6;
    }
}
