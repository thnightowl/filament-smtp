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

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasMigration('create_filament_smtp_table')
            ->hasRoute('web');
    }
}