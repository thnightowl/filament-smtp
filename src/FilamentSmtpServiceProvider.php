<?php

namespace TheNightOwl\FilamentSmtp;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentSmtpServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-smtp';

    protected array $resources = [
        // CustomResource::class,
    ];

    protected array $pages = [
        // CustomPage::class,
    ];

    protected array $widgets = [
        // CustomWidget::class,
    ];

    protected array $styles = [
        'plugin-filament-smtp' => __DIR__.'/../resources/dist/filament-smtp.css',
    ];

    protected array $scripts = [
        'plugin-filament-smtp' => __DIR__.'/../resources/dist/filament-smtp.js',
    ];

    // protected array $beforeCoreScripts = [
    //     'plugin-filament-smtp' => __DIR__ . '/../resources/dist/filament-smtp.js',
    // ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name);
    }
}
