<?php

use Astrotomic\SteamSdk\Data\StoreApp;
use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns app details', function (int $appid): void {
    $apps = app(SteamConnector::class)->appDetails($appid);

    Assert::assertInstanceOf(StoreApp::class, $apps);
})->with('appids');
