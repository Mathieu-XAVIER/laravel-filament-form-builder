<?php

namespace Novius\LaravelFormBuilder\Filament;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Novius\LaravelFormBuilder\Filament\Resources\FormResource;
use Novius\LaravelFormBuilder\Filament\Resources\FormResponseResource;

class FormBuilderPlugin implements Plugin
{
    /**
     * @var array<string, class-string>
     */
    protected array $resources = [
        'forms' => FormResource::class,
        'form-responses' => FormResponseResource::class,
    ];

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'laravel-filament-form-builder';
    }

    public function register(Panel $panel): void
    {
        $panel->resources($this->resources);
    }

    public function boot(Panel $panel): void {}
}
