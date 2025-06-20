<?php

namespace Novius\LaravelFormBuilder\Filament\Exports;

use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;

class FormResponseExporter extends Exporter
{
    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
            ExportColumn::make('response'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public function getFormats(): array
    {
        return [
            ExportFormat::Csv,
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        return __('laravel-filament-form-builder::response.export_success');
    }
}
