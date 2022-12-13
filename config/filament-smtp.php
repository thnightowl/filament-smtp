<?php

// config for TheNightOwl/FilamentSmtp
return [
    /*
    |--------------------------------------------------------------------------
    | Set the model label for the FilamentSmtpResource.
    */
    'model_label' => 'Mail Settings',
    /*
    |--------------------------------------------------------------------------
    | Set the slug for the FilamentSmtpResource.
    */
    'slug' => 'mail-settings',
    /*
    |--------------------------------------------------------------------------
    | Set the navigation icon for the FilamentSmtpResource.
    */
    'navigation_icon' => 'heroicon-o-mail',
    /*
    |--------------------------------------------------------------------------
    | Set the table name for the smtp settings table.
    */
    'table_name' => 'smtp_settings',
    /*
    |--------------------------------------------------------------------------
    | Set the model for the FilamentSmtpResource.
    */
    'model' => \TheNightOwl\FilamentSmtp\Models\FilamentSmtp::class,
];