<?php

namespace Novius\LaravelFormBuilder\Filament\Resources;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Novius\LaravelForm\Models\Form as FormModel;
use Novius\LaravelFormBuilder\Filament\Resources\FormResource\Pages;

class FormResource extends Resource
{
    protected static ?string $model = FormModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    public static function getModelLabel(): string
    {
        return trans('laravel-filament-form-builder::form.form');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('laravel-filament-form-builder::form.forms');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('laravel-filament-form-builder::form.form_name'))
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, Set $set) {
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->label(__('laravel-filament-form-builder::form.slug'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->regex('/^[a-z][-a-z0-9]*$/')
                    ->helperText('Le slug doit commencer par une lettre minuscule et ne contenir que des lettres, chiffres ou tirets.'),

                Select::make('after_sent_action')
                    ->label(__('laravel-filament-form-builder::form.after_sent_action'))
                    ->options(FormModel::afterSentActions())
                    ->required()
                    ->live(),

                MarkdownEditor::make('after_sent_message')
                    ->label(__('laravel-filament-form-builder::form.success_message_sent'))
                    ->visible(fn($get) => $get('after_sent_action') === FormModel::AFTER_SENT_ACTION_MESSAGE)
                    ->requiredIf('after_sent_action', FormModel::AFTER_SENT_ACTION_MESSAGE),

                TextInput::make('after_sent_redirection_url')
                    ->label(__('laravel-filament-form-builder::form.redirection_url_field'))
                    ->visible(fn($get) => $get('after_sent_action') === FormModel::AFTER_SENT_ACTION_REDIRECTION)
                    ->requiredIf('after_sent_action', FormModel::AFTER_SENT_ACTION_REDIRECTION)
                    ->url(),

                Toggle::make('after_sent_notification')
                    ->label(__('laravel-filament-form-builder::form.enable_mail_notification_field'))
                    ->live(),

                Textarea::make('after_sent_notification_recipients')
                    ->label(__('laravel-filament-form-builder::form.notification_recipients_field'))
                    ->helperText(__('laravel-filament-form-builder::form.mail_notification_recipients_help'))
                    ->rows(3)
                    ->visible(fn($get) => $get('after_sent_notification'))
                    ->requiredIf('after_sent_notification', true)
                    ->rule('email'),

                TextInput::make('after_sent_notification_subject')
                    ->label(__('laravel-filament-form-builder::form.notification_subject'))
                    ->visible(fn($get) => $get('after_sent_notification'))
                    ->requiredIf('after_sent_notification', true),

                TextInput::make('form_element_custom_classes')
                    ->label(__('laravel-filament-form-builder::form.html_classes')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->label(__('laravel-filament-form-builder::form.form_name'))->searchable(),
                TextColumn::make('slug')->label(__('laravel-filament-form-builder::form.slug')),
                IconColumn::make('after_sent_notification')->label(__('laravel-filament-form-builder::form.enable_mail_notification_field')),
            ])
            ->actions([
                Tables\Actions\Action::make('manage_fields')
                    ->label(__('laravel-filament-form-builder::form.manage_fields'))
                    ->icon('heroicon-o-rectangle-group')
                    ->url(fn ($record) => FormResource::getUrl('manage-fields', ['record' => $record]))
                    ->openUrlInNewTab()
                    ->color(Color::Blue),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListForms::route('/'),
            'create' => Pages\CreateForm::route('/create'),
            'edit' => Pages\EditForm::route('/{record}/edit'),
            'manage-fields' => Pages\ManageFields::route('/{record}/fields'),
        ];
    }
}
