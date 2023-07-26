<?php

namespace Tests;

use Astrotomic\SteamSdk\SteamConnector;
use Astrotomic\SteamSdk\SteamSdkServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Saloon\Http\Faking\Fixture;
use Saloon\Http\Faking\MockResponse;
use Saloon\Http\PendingRequest;
use Saloon\Laravel\Facades\Saloon;

abstract class TestCase extends Orchestra
{
    protected $enablesPackageDiscoveries = true;

    protected SteamConnector $steam;

    protected function setUp(): void
    {
        parent::setUp();

        Saloon::fake([
            SteamConnector::class => function (PendingRequest $request): Fixture {
                $name = implode('/', array_filter([
                    parse_url($request->getUrl(), PHP_URL_HOST),
                    $request->getMethod()->value,
                    parse_url($request->getUrl(), PHP_URL_PATH),
                    http_build_query(array_diff_key($request->query()->all(), array_flip(['key', 'format']))),
                ]));

                return MockResponse::fixture($name);
            },
        ]);

        $this->steam = new SteamConnector(getenv('STEAM_API_KEY'));
    }

    protected function getPackageProviders($app): array
    {
        return [
            SteamSdkServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('services.steam', [
            'api_key' => env('STEAM_API_KEY'),
        ]);
    }
}
