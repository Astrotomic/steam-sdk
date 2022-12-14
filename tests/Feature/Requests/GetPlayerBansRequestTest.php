<?php

use Astrotomic\SteamSdk\Data\PlayerBan;
use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns player bans', function (string $steamid): void {
    $bans = app(SteamConnector::class)->getPlayerBans(steamids: $steamid);

    Assert::assertContainsOnlyInstancesOf(PlayerBan::class, $bans);

    $bans->each(function (PlayerBan $ban): void {
        Assert::assertSame($ban->steamid, $ban->steamid()->ConvertToUInt64());
    });
})->with('userids');

it('returns single player bans', function (string $steamid): void {
    $ban = app(SteamConnector::class)->getPlayerBan(steamid: $steamid);

    Assert::assertInstanceOf(PlayerBan::class, $ban);

    Assert::assertSame($ban->steamid, $ban->steamid()->ConvertToUInt64());
})->with('userids');
