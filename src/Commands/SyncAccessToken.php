<?php

namespace TheNightOwl\FilamentSmtp\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncAccessToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filament-smtp:sync-access-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync access token from refresh token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment('Syncing access token...');
        $smtp = (config('filament-smtp.model'))::where('is_default', 1)->first();

        if ($smtp) {
            $this->comment('Default SMTP found!');
            $this->comment('Refreshing access token...');

            $response = Http::asForm()->post('https://oauth2.googleapis.com/token?refresh_token='
                . urlencode($smtp->refresh_token) . '&client_id=' . config('services.google.client_id')
                . '&client_secret=' . config('services.google.client_secret') . '&grant_type=refresh_token', []);

            if (!isset($response->json()['access_token'])) {
                $this->comment('Error: ' . $response->json()['error'] . ' - ' . $response->json()['error_description']);
                return 0;
            }

            $smtp->access_token = $response->json()['access_token'];

            $smtp->save();

            $this->comment('Access token refreshed successfully!');
            return 1;
        }

        $this->comment('No default SMTP found!');
        return 1;
    }

}