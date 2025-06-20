<?php

namespace Novius\LaravelFormBuilder\Filament\Resources;

use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Novius\LaravelForm\Models\FormResponse as FormResponseModel;
use Novius\LaravelFormBuilder\Filament\Exports\FormResponseExporter;
use Novius\LaravelFormBuilder\Filament\Resources\FormResponseResource\Pages;

class FormResponseResource extends Resource
{
    protected static ?string $model = FormResponseModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getModelLabel(): string
    {
        return trans('laravel-filament-form-builder::response.response');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('laravel-filament-form-builder::response.responses');
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('response')
                    ->label(__('laravel-filament-form-builder::response.response'))
                    ->formatStateUsing(function ($record) {
                        $responses = $record->responsesWithReadableFormat('summary');
                        return collect($responses)
                            ->map(fn($item) => "<strong>{$item['label']}:</strong> {$item['value']}")
                            ->implode('<br>');
                    })
                    ->html()
                    ->limit(100),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('created_from')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Date de début'),
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['created_from']) {
                            $query->whereDate('created_at', '>=', $data['created_from']);
                        }
                    }),
                Filter::make('created_until')
                    ->form([
                        DatePicker::make('created_until')
                            ->label('Date de fin'),
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['created_until']) {
                            $query->whereDate('created_at', '<=', $data['created_until']);
                        }
                    })
            ])
            ->headerActions([
                ExportAction::make()->exporter(FormResponseExporter::class)
            ])
            ->actions([
                ViewAction::make()
                    ->color('primary'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormResponses::route('/'),
            'view' => Pages\ViewFormResponse::route('/{record}'),
        ];
    }
}
