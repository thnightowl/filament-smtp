<?php

namespace TheNightOwl\FilamentSmtp;

use Filament\PluginServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Spatie\LaravelPackageTools\Package;
use TheNightOwl\FilamentSmtp\Commands\SyncAccessToken;
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
            ->hasRoute('web')
            ->hasCommands($this->getCommands());
    }

    public function boot()
    {
        parent::boot();
        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            // every hour
            $schedule->command('filament-smtp:sync-access-token')->everyminute();
        });
    }

    protected function getCommands(): array
    {
        return [
            SyncAccessToken::class,
        ];
    }
}