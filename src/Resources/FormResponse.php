<?php

namespace Novius\LaravelFormBuilder\Resources;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;
use Novius\LaravelForm\Models\FormResponse as FormResponseModel;
use Novius\LaravelFormBuilder\Actions\ExportAnswers;
use Novius\LaravelFormBuilder\Filters\ResponseDateFromFilter;
use Novius\LaravelFormBuilder\Filters\ResponseDateToFilter;

/**
 * @extends Resource<FormResponseModel>
 */
class FormResponse extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = FormResponseModel::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'response',
    ];

    public static $displayInNavigation = false;

    public static $globallySearchable = false;

    public static function label()
    {
        return trans('laravel-form-builder::response.responses');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(trans('laravel-form-builder::response.response'), function () {
                return $this->displayResponsesAsHtmlSummary($this->resource);
            })
                ->asHtml()
                ->onlyOnIndex(),

            Text::make(trans('laravel-form-builder::response.response'), function () {
                return $this->displayResponsesAsHtmlTable($this->resource);
            })
                ->asHtml()
                ->onlyOnDetail(),

            DateTime::make('Created At')
                ->onlyOnIndex(),
        ];
    }

    protected function displayResponsesAsHtmlSummary(FormResponseModel $formResponse): string
    {
        $responses = $formResponse->responsesWithReadableFormat('summary');
        $fieldsLimit = (int) config('laravel-form-builder.index_responses_summary_limit_fields', 5);
        $responseFields = [];
        $totalResponses = count($responses);

        foreach ($responses as $response) {
            $responseFields[] = sprintf('<div class="py-1"><strong>%s :&nbsp;</strong><span style="white-space: break-spaces">%s</span></div>', $response['label'], $response['value']);
            if ($totalResponses > $fieldsLimit && count($responseFields) >= $fieldsLimit) {
                $responseFields[] = '...';

                break;
            }
        }

        return sprintf('<div class="py-2">%s</div>', implode('', $responseFields));
    }

    protected function displayResponsesAsHtmlTable(FormResponseModel $formResponse): string
    {
        $responses = $formResponse->responsesWithReadableFormat();
        $responseFields = [];
        foreach ($responses as $response) {
            $responseFields[] = sprintf('<tr><td class="w-1/4">%s</td><td>%s</td></tr>', $response['label'], $response['value']);
        }

        return sprintf('<table class="table">%s</table>', implode('', $responseFields));
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new ResponseDateFromFilter,
            new ResponseDateToFilter,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            ExportAnswers::make(),
        ];
    }
}
