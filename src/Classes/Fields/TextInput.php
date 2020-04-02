<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

class TextInput extends AbstractField
{
    public static $model = \Novius\LaravelForm\Classes\Fields\TextInput::class;

    /**
     * {@inheritdoc}
     */
    public function position(): int
    {
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function params(): array
    {
        return array_merge((static::newModel())->defaultParams(), [
            'group' => 'form',
            'text' => trans('laravel-form-builder::fields.text_field_name'),
            'isUnique' => false,
            'isHelpBlockVisible' => true,
            'isPlaceholderVisible' => true,
        ]);
    }
}
