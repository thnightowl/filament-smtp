<?php

namespace TheNightOwl\FilamentSmtp\Resources;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use TheNightOwl\FilamentSmtp\Resources\FilamentSmtpResource\Pages;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class FilamentSmtpResource extends Resource
{
    public static function getModelLabel(): string
    {
        return config('filament-smtp.model_label');
    }

    public static function getSlug(): string
    {
        return config('filament-smtp.slug');
    }

    public static function getModel(): string
    {
        return config('filament-smtp.model');
    }

    public static function getNavigationIcon(): string
    {
        return config('filament-smtp.navigation_icon');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('username')->label('Username')->searchable()->sortable(),
                ToggleColumn::make('is_default')->label('Default')->searchable()->sortable(),
                TextColumn::make('created_at')->label('Created')->since()->searchable()->sortable(),
                TextColumn::make('last_used_at')->label('Updated')->since()->searchable()->sortable(),
            ])
            ->filters([

            ])
            ->actions([
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFilamentSmtps::route('/'),
        ];
    }
}