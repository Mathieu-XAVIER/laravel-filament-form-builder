<?php

namespace Novius\LaravelFormBuilder\Filament\Resources\FormResource\Pages;

use Filament\Resources\Pages\Page;
use Novius\LaravelForm\Models\Form as FormModel;
use Novius\LaravelFormBuilder\Filament\Resources\FormResource;

class ManageFields extends Page
{
    protected static string $resource = FormResource::class;
    protected static string $view = 'laravel-filament-form-builder::filament.resources.form-resource.pages.manage-fields';

    public FormModel $record;

    public function mount($record): void
    {
        if (is_string($record) || is_numeric($record)) {
            $this->record = FormModel::findOrFail($record);
        } else {
            $this->record = $record;
        }
    }

    protected function getViewData(): array
    {
        return [
            'record' => $this->record,
        ];
    }
}
