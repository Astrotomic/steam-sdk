<?php

use Astrotomic\SteamSdk\Data\App;
use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns app list', function (): void {
    $appList = app(SteamConnector::class)->getAppList();

    Assert::assertContainsOnlyInstancesOf(App::class, $appList);
});
