<?php

namespace TheNightOwl\FilamentSmtp;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use TheNightOwl\FilamentSmtp\Resources\FilamentSmtpResource;

class FilamentSmtpServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-smtp';

    protected array $resources = [
        FilamentSmtpResource::class,
    ];

    protected array $pages = [
        // CustomPage::class,

    ];

    protected array $widgets = [
        // CustomWidget::class,

    ];

    protected array $styles = [
        'plugin-filament-smtp' => __DIR__ . '/../resources/dist/filament-smtp.css',
    ];

    protected array $scripts = [
        'plugin-filament-smtp' => __DIR__ . '/../resources/dist/filament-smtp.js',
    ];

    // protected array $beforeCoreScripts = [
    //     'plugin-filament-smtp' => __DIR__ . '/../resources/dist/filament-smtp.js',
    // ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasMigration('create_filament_smtp_table')
            ->hasRoute('web');
    }
}