<?php

namespace TheNightOwl\FilamentSmtp\Resources\FilamentSmtpResource\Pages;

use Filament\Pages\Actions\ButtonAction;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Socialite\Facades\Socialite;
use TheNightOwl\FilamentSmtp\Facades\Mail;
use TheNightOwl\FilamentSmtp\Mail\TestMail;
use TheNightOwl\FilamentSmtp\Resources\FilamentSmtpResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;

class ListFilamentSmtps extends ListRecords
{
    protected static string $resource = FilamentSmtpResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('user_id', auth()->id());
    }

    protected function isTablePaginationEnabled(): bool
    {
        return true;
    }

    protected function getActions(): array
    {
        return [
            ButtonAction::make('Google')
                ->icon('heroicon-o-login')
                ->action(fn() => $this->loginRedirect()),
            ButtonAction::make('Test')
                ->icon('heroicon-o-mail')
                ->action(fn() => $this->testMail())
        ];
    }

    public function loginRedirect()
    {
        $scopes = [
            'https://mail.google.com',
        ];

        return redirect(Socialite::driver('google')
            ->scopes($scopes)
            ->with(["access_type" => "offline", "prompt" => "consent select_account"])
            ->redirect()->getTargetUrl());
    }

    public function testMail()
    {
        try {
            Mail::to(auth()->user()->email)->send(new TestMail());
        } catch (\Exception $e) {
            Notification::make()->title($e->getMessage())->danger()->send();
            return;
        }

        return Notification::make()->title('Email sent successfully')->success()->send();
    }

    public function mount(): void
    {
        if (session('googleUser')) {

            $removeDefault = (config('filament-smtp.model'))::where(['user_id' => auth()->id(), 'is_default' => 1])->first();

            if ($removeDefault) {
                $removeDefault->is_default = 0;
                $removeDefault->save();
            }

            $smtp = (config('filament-smtp.model'))::where(['user_id' => auth()->id(), 'username' => session('googleUser')->email])->first();

            if (!$smtp) {
                $smtp = new (config('filament-smtp.model'));
            }

            $smtp->driver = 'smtp';
            $smtp->host = 'smtp.gmail.com';
            $smtp->port = '465';
            $smtp->encryption = 'tls';
            $smtp->username = session('googleUser')->email;
            $smtp->password = session('googleUser')->token;
            $smtp->user_id = auth()->user()->id;
            $smtp->from_address = session('googleUser')->email;
            $smtp->from_name = session('googleUser')->name;
            $smtp->is_default = 1;
            $smtp->access_token = session('googleUser')->token;
            $smtp->refresh_token = session('googleUser')->refreshToken;

            $smtp->save();
        }
    }
}