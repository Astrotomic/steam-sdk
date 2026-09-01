<?php

use Astrotomic\SteamSdk\Data\RecentlyPlayedApp;
use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns a player\'s recently played apps', function (string $steamid): void {
    $apps = app(SteamConnector::class)->getRecentlyPlayedGames(steamid: $steamid);

    Assert::assertContainsOnlyInstancesOf(RecentlyPlayedApp::class, $apps);

})->with('userids');

it('returns an empty collection', function (string $steamid): void {
    $apps = app(SteamConnector::class)->getRecentlyPlayedGames(steamid: $steamid);

    Assert::assertEmpty($apps);

})->with('privateuserids');
