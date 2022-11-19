<?php

use Astrotomic\SteamSdk\Data\Friend;
use Astrotomic\SteamSdk\Exceptions\UnauthorizedException;
use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns friend list', function (string $steamid): void {
    try {
        $friends = app(SteamConnector::class)->getFriendList(steamid: $steamid);

        Assert::assertContainsOnlyInstancesOf(Friend::class, $friends);

        $friends->each(function (Friend $friend): void {
            Assert::assertSame($friend->steamid, $friend->steamid()->ConvertToUInt64());
        });
    } catch (UnauthorizedException $exception) {
        Assert::assertInstanceOf(UnauthorizedException::class, $exception);
    }
})->with('userids');
