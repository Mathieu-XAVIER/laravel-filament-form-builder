<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

class UploadInput extends AbstractField
{
    public static $model = \Novius\LaravelForm\Classes\Fields\UploadInput::class;

    /**
     * {@inheritdoc}
     */
    public function position(): int
    {
        return 7;
    }

    /**
     * {@inheritdoc}
     */
    public function params(): array
    {
        return array_merge((static::newModel())->defaultParams(), [
            'text' => trans('laravel-form-builder::fields.upload_field_name'),
            'group' => 'form',
            'isUnique' => false,
            'isHelpBlockVisible' => true,
        ]);
    }
}
