<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

class NumberInput extends AbstractField
{
    public static $model = \Novius\LaravelForm\Classes\Fields\NumberInput::class;

    /**
     * {@inheritdoc}
     */
    public function position(): int
    {
        return 3;
    }

    /**
     * {@inheritdoc}
     */
    public function params(): array
    {
        return array_merge((static::newModel())->defaultParams(), [
            'text' => trans('laravel-form-builder::fields.number_input_field_name'),
            'group' => 'form',
            'isUnique' => false,
            'advancedOptions' => true,
            'hasMinValue' => true,
            'hasMaxValue' => true,
            'isHelpBlockVisible' => true,
            'isPlaceholderVisible' => true,
        ]);
    }
}
