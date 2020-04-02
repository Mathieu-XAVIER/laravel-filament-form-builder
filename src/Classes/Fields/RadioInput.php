<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

class RadioInput extends AbstractField
{
    public static $model = \Novius\LaravelForm\Classes\Fields\RadioInput::class;

    /**
     * {@inheritdoc}
     */
    public function position(): int
    {
        return 5;
    }

    /**
     * {@inheritdoc}
     */
    public function params(): array
    {
        return array_merge((static::newModel())->defaultParams(), [
            'group' => 'form',
            'text' => trans('laravel-form-builder::fields.radio_field_name'),
            'isHelpBlockVisible' => true,
            'isUnique' => false,
            'advancedOptions' => true,
        ]);
    }
}
