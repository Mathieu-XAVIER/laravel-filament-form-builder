<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

class SelectList extends AbstractField
{
    public static $model = \Novius\LaravelForm\Classes\Fields\SelectList::class;

    /**
     * {@inheritdoc}
     */
    public function position(): int
    {
        return 4;
    }

    /**
     * {@inheritdoc}
     */
    public function params(): array
    {
        return array_merge((static::newModel())->defaultParams(), [
            'text' => trans('laravel-form-builder::fields.select_field_name'),
            'group' => 'form',
            'isUnique' => false,
            'isHelpBlockVisible' => true,
            'advancedOptions' => true,
        ]);
    }
}
