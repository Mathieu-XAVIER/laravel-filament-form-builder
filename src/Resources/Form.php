<?php

namespace Novius\LaravelFormBuilder\Resources;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Form extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Novius\LaravelForm\Models\Form::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    public static function label()
    {
        return trans('laravel-form-builder::form.forms');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(trans('laravel-form-builder::form.form_name'), 'name')
                ->rules('required'),

            Slug::make(trans('laravel-form-builder::form.slug'), 'slug')
                ->rules('required', 'max:191', function ($attribute, $value, $fail) {
                    if (!preg_match('/^[a-z][-a-z0-9]*$/', $value)) {
                        return $fail('The '.$attribute.' field must be a valid slug.');
                    }
                })
                ->from('name')
                ->creationRules('unique:forms,slug')
                ->updateRules('unique:forms,slug,{{resourceId}}'),

            Text::make(trans('laravel-form-builder::form.update_fields'), function () {
                return sprintf('<a class="no-underline dim text-primary font-bold" href="%s">%s</a>', '/admin/laravel-form-builder/'.$this->id, trans('laravel-form-builder::form.update_fields'));
            })
                ->asHtml()
                ->exceptOnForms(),

            Select::make(trans('laravel-form-builder::form.after_sent_action'), 'after_sent_action')
                ->options(\Novius\LaravelForm\Models\Form::afterSentActions())
                ->displayUsingLabels()
                ->rules('required', 'in:'.implode(',', \Novius\LaravelForm\Models\Form::afterSentActionsIds()))
                ->hideFromIndex(),


            Markdown::make(trans('laravel-form-builder::form.success_message_sent'), 'after_sent_message')
                ->hide()
                ->rules('required_if:after_sent_action,'.\Novius\LaravelForm\Models\Form::AFTER_SENT_ACTION_MESSAGE)
                ->hideFromIndex()
                ->dependsOn('after_sent_action', function (Markdown $field, NovaRequest $request, FormData $formData) {
                    if ($formData->after_sent_action === \Novius\LaravelForm\Models\Form::AFTER_SENT_ACTION_MESSAGE) {
                        $field->show()->required();
                    }
                }),


            Text::make(trans('laravel-form-builder::form.redirection_url_field'), 'after_sent_redirection_url')
                ->hide()
                ->rules('required_if:after_sent_action,'.\Novius\LaravelForm\Models\Form::AFTER_SENT_ACTION_REDIRECTION, 'url')
                ->hideFromIndex()
                ->dependsOn('after_sent_action', function (Text $field, NovaRequest $request, FormData $formData) {
                    if ($formData->after_sent_action === \Novius\LaravelForm\Models\Form::AFTER_SENT_ACTION_REDIRECTION) {
                        $field->show()->required();
                    }
                }),

            Boolean::make(trans('laravel-form-builder::form.enable_mail_notification_field'), 'after_sent_notification'),

            Textarea::make(trans('laravel-form-builder::form.notification_recipients_field'), 'after_sent_notification_recipients')
                ->help(trans('laravel-form-builder::form.mail_notification_recipients_help'))
                ->rows(3)
                ->hide()
                ->rules('required_if:after_sent_notification,'.\Novius\LaravelForm\Models\Form::AFTER_SENT_ACTION_MESSAGE, function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        $emails = explode(',', $value);
                        foreach ($emails as $email) {
                            $validator = Validator::make(['email' => $email], [
                                'email' => 'required|email',
                            ]);

                            if (!$validator->passes()) {
                                return $fail(trans('laravel-form-builder::form.notification_recipients_format_error'));
                            }
                        }
                    }
                })
                ->dependsOn(
                    ['after_sent_notification'],
                    function (Textarea $field, NovaRequest $request, FormData $formData) {
                        if (! empty($formData->after_sent_notification)) {
                            $field->show()->required();
                        }
                    }
                ),

            Text::make(trans('laravel-form-builder::form.notification_subject'), 'after_sent_notification_subject')
                ->rules('required_if:after_sent_notification,'.\Novius\LaravelForm\Models\Form::AFTER_SENT_ACTION_MESSAGE)
                ->hideFromIndex()
                ->hide()
                ->dependsOn(
                    ['after_sent_notification'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if (! empty($formData->after_sent_notification)) {
                            $field->show();
                        }
                    }
                )
                ->required(),

            Text::make(trans('laravel-form-builder::form.html_classes'), 'form_element_custom_classes')
                ->hideFromIndex(),

            HasMany::make(trans('laravel-form-builder::response.responses'), 'responses', FormResponse::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
