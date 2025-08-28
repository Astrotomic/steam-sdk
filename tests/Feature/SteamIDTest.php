<?php

use Astrotomic\SteamSdk\SteamID;
use PHPUnit\Framework\Assert;

it('resolves valid steam id variants', function (string|int $steamid): void {
    $id1 = SteamID::make($steamid);
    $id2 = new SteamID($steamid);

    Assert::assertSame(76561198061912622, $id1->toSteamID());
    Assert::assertSame(76561198061912622, $id2->toSteamID());
})->with([
    // AccountID
    ['101646894'],
    [101646894],
    // SteamID
    ['76561198061912622'],
    [76561198061912622],
    // Steam2 ID
    ['STEAM_1:0:50823447'],
    // Steam3 ID
    ['[U:1:101646894]'],
    // CS2 Friend
    ['SSMBR-JADJ'],
    // Steam3 Hex
    ['steam:1100001060f022e'],
    // Vanity URL
    ['https://steamcommunity.com/profiles/76561198061912622'],
    ['https://steamcommunity.com/profiles/[U:1:101646894]'],
    ['https://steamcommunity.com/id/gummibeer/'],
    ['https://s.team/p/jbw-bddv'],
]);
