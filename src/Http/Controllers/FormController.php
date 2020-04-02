<?php

namespace Novius\LaravelFormBuilder\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Novius\LaravelForm\Models\Form;
use Novius\LaravelFormBuilder\Classes\Fields\AbstractField;

class FormController extends Controller
{
    public function formFields(Request $request, int $id)
    {
        $form = Form::findOrFail($id);
        $defaultfields = collect(config('laravel-form-builder.fields_type_matching', []))
            ->map(function ($class, $component) {
                if (!class_exists($class)) {
                    return [];
                }

                $field = new $class();
                if (!$field instanceof AbstractField) {
                    return [];
                }

                return [
                    'position' => $field->position(),
                    'infos' => $field->params(),
                    'component' => $component,
                ];
            })
            ->filter()
            ->sortBy('position')
            ->map(function ($field) {
                return $field['infos'];
            })
            ->values();

        return response()->json([
            'defaultFields' => $defaultfields->all(),
            'fields' => !empty($form->fields) ? $form->fields : $this->initialInterfaceFields(),
            'error' => 0,
            'formName' => $form->name,
        ]);
    }

    protected function initialInterfaceFields():array
    {
        return [
            [
                'title' => '',
                'fields' => [],
            ],
        ];
    }

    public function store(Request $request, int $id)
    {
        $form = Form::findOrFail($id);
        $fields = json_decode((string) $request->get('fields', ''), true);
        $nbFields = collect($fields)->pluck('fields')->flatten(1)->count();

        $form->fields = $fields;
        $saved = $form->save();

        return response()->json([
            'error' => ($saved ? 0 : 1),
            'message' => $saved ? trans_choice('laravel-form-builder::form.fields_saved', $nbFields) : trans('laravel-form-builder::form.saving_fields_error'),
        ]);
    }
}
