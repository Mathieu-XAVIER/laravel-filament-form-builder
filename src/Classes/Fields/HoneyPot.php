<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

class HoneyPot extends AbstractField
{
    public static $model = \Novius\LaravelForm\Classes\Fields\HoneyPot::class;

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
            'text' => trans('laravel-form-builder::fields.honeypot_field_name'),
            'isUnique' => true,
        ]);
    }
}
