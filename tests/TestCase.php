<?php

namespace Tests;

use Astrotomic\SteamSdk\SteamConnector;
use Astrotomic\SteamSdk\SteamSdkServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Sammyjo20\Saloon\Http\Fixture;
use Sammyjo20\Saloon\Http\MockResponse;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\SaloonLaravel\Facades\Saloon;

abstract class TestCase extends Orchestra
{
    protected $enablesPackageDiscoveries = true;

    protected SteamConnector $steam;

    protected function setUp(): void
    {
        parent::setUp();

        Saloon::fake([
            SteamConnector::class => function (SaloonRequest $request): Fixture {
                $name = implode('/', array_filter([
                    parse_url($request->getFullRequestUrl(), PHP_URL_HOST),
                    mb_strtoupper($request->getMethod() ?? 'GET'),
                    parse_url($request->getFullRequestUrl(), PHP_URL_PATH),
                    http_build_query(array_diff_key($request->getQuery(), array_flip(['key', 'format']))),
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
