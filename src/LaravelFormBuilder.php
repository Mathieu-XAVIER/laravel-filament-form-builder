<?php

namespace Novius\LaravelFormBuilder;

use Illuminate\Http\Request;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class LaravelFormBuilder extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('laravel-form-builder', __DIR__.'/../dist/js/tool.js');
        Nova::style('laravel-form-builder', __DIR__.'/../dist/css/tool.css');
    }

    public function menu(Request $request)
    {
        //
    }
}
