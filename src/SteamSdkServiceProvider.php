<?php

namespace Astrotomic\SteamSdk;

use Illuminate\Support\ServiceProvider;

class SteamSdkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SteamConnector::class, function (): SteamConnector {
            return new SteamConnector(
                apiKey: config('services.steam.api_key'),
            );
        });
    }
}
