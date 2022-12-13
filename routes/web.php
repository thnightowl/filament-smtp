<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get(config('filament-smtp.redirect_url'), function () {
    $user = Socialite::driver('google')->user();
    return redirect()->route('filament.resources.' . config('filament-smtp.slug') . '.index')->with('googleUser', $user);
})->name('auth.callback')->middleware('web');