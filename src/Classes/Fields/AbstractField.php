<?php

namespace Novius\LaravelFormBuilder\Classes\Fields;

use Novius\LaravelFormBuilder\Contracts\FormField;

abstract class AbstractField implements FormField
{
    public static $model;

    /**
     * Get a fresh instance of the field represented by the form builder field.
     *
     * @return mixed
     */
    protected static function newModel()
    {
        $model = static::$model;

        return new $model;
    }
}
