<?php

use Astrotomic\SteamSdk\Data\OwnedApp;
use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns a player\'s owned apps', function (string $steamid): void {
    $apps = app(SteamConnector::class)->getOwnedGames(steamid: $steamid);

    Assert::assertContainsOnlyInstancesOf(OwnedApp::class, $apps);

})->with('userids');
