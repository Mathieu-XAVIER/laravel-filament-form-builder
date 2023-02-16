<?php

namespace Novius\LaravelFormBuilder\Actions;

use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\Response;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\ActionRequest;
use Novius\LaravelForm\Models\Form;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportAnswers extends Action
{
    public $responseType = 'blob';

    public $withoutActionEvents = true;

    public function name()
    {
        return trans('laravel-form-builder::response.export_responses');
    }

    protected function dispatchRequestUsing(ActionRequest $request, Response $response, ActionFields $fields)
    {
        $this->then(function ($results) {
            return $results->first();
        });

        $query = $request->toSelectedResourceQuery();
        $firstModel = $query->clone()->first();

        if (empty($firstModel)) {
            return $response->failed();
        }

        $form = Form::withTrashed()->find($firstModel->form_id);
        if (empty($form)) {
            return $response->failed();
        }

        // Only allow current form fields for export
        $mostRecentFieldNames = collect($firstModel->responsesWithReadableFormat('export'))
            ->pluck('label', 'name')
            ->sort()
            ->all();

        $eloquentGenerator = function () use ($query) {
            foreach ($query->cursor() as $model) {
                yield $model;
            }
        };

        $filename = sprintf('%s-%d', 'form-export', now()->format('YmdHis'));
        $extension = 'csv';
        $exportFilename = sprintf(
            '%s.%s',
            $filename,
            $extension
        );

        return $response->successful([
            (new FastExcel($eloquentGenerator()))->download($exportFilename, function ($model) use ($mostRecentFieldNames) {
                $answers = $model->responsesWithReadableFormat('export');

                return collect($mostRecentFieldNames)
                    ->map(function ($fieldLabel, $fieldName) use ($answers) {
                        $answer = collect($answers)
                            ->firstWhere('name', $fieldName);

                        return [
                            'label' => $fieldLabel,
                            'value' => $answer['value'] ?? '',
                        ];
                    })
                    ->pluck('value', 'label')
                    ->all();
            }),
        ]);
    }
}
