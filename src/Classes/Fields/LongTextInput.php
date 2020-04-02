<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

class LongTextInput extends AbstractField
{
    public static $model = \Novius\LaravelForm\Classes\Fields\LongTextInput::class;

    /**
     * {@inheritdoc}
     */
    public function position(): int
    {
        return 2;
    }

    /**
     * {@inheritdoc}
     */
    public function params(): array
    {
        return array_merge((static::newModel())->defaultParams(), [
            'text' => trans('laravel-form-builder::fields.longtext_field_name'),
            'group' => 'form',
            'isUnique' => false,
            'isHelpBlockVisible' => true,
            'isPlaceholderVisible' => true,
        ]);
    }
}
