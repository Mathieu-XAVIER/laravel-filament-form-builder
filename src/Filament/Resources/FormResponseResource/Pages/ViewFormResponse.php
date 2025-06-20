<?php

namespace Novius\LaravelFormBuilder\Filament\Resources\FormResponseResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;
use Novius\LaravelFormBuilder\Filament\Resources\FormResponseResource;

class ViewFormResponse extends ViewRecord
{
    protected static string $resource = FormResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')->disabled(),
                Placeholder::make('response')
                    ->label(__('laravel-filament-form-builder::response.response'))
                    ->content(function ($record) {
                        $responses = $record->responsesWithReadableFormat('summary');
                        return collect($responses)
                            ->map(fn($item) => "{$item['label']} : {$item['value']}")
                            ->implode("\n");
                    })
                    ->columnSpanFull(),
                TextInput::make('created_at')->disabled(),
                TextInput::make('updated_at')->disabled(),
            ]);
    }
}

