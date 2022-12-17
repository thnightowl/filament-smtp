<?php

namespace TheNightOwl\FilamentSmtp\Facades;

use Illuminate\Support\Facades\Mail as ParentMail;

class Mail extends ParentMail
{

    public static function __callStatic($method, $parameters)
    {
        $smtp = (config('filament-smtp.model'))::where('is_default', 1)->first();

        if ($smtp) {
            config([
                'mail.mailers.smtp.driver' => $smtp->driver,
                'mail.mailers.smtp.host' => $smtp->host,
                'mail.mailers.smtp.port' => $smtp->port,
                'mail.mailers.smtp.encryption' => $smtp->encryption,
                'mail.mailers.smtp.username' => $smtp->username,
                'mail.mailers.smtp.password' => $smtp->access_token,
                'mail.from.address' => $smtp->from_address,
                'mail.from.name' => $smtp->from_name,
            ]);
        }

        return parent::__callStatic($method, $parameters);
    }

}