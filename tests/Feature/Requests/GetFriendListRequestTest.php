<?php

use Astrotomic\SteamSdk\Data\Friend;
use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns friend list', function (string $steamid): void {
    $friends = app(SteamConnector::class)->getFriendList(steamid: $steamid);

    Assert::assertContainsOnlyInstancesOf(Friend::class, $friends);

    $friends->each(function (Friend $friend): void {
        Assert::assertSame($friend->steamid, $friend->steamid()->ConvertToUInt64());
    });
})->with('userids');
