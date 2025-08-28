<?php

use PHPUnit\Framework\Assert;
use xPaw\Steam\SteamID;

it('returns resolved steamid', closure: function (string $vanityurl, string $expected): void {
    $steamid = $this->steam->resolveVanityUrl(vanityurl: $vanityurl);

    Assert::assertInstanceOf(SteamID::class, $steamid);
    Assert::assertSame($expected, $steamid->ConvertToUInt64());
})->with([
    ['https://steamcommunity.com/profiles/76561198061912622', '76561198061912622'],
    ['https://steamcommunity.com/profiles/[U:1:101646894]', '76561198061912622'],
    ['https://steamcommunity.com/id/gummibeer/', '76561198061912622'],
    ['https://s.team/p/jbw-bddv', '76561198061912622'],
    ['https://steamcommunity.com/groups/archiasf', '103582791440160998'],
]);

it('returns null for invalid vanity', closure: function (string $vanityurl): void {
    $steamid = $this->steam->resolveVanityUrl(vanityurl: $vanityurl);

    Assert::assertNull($steamid);
})->with([
    'https://steamcommunity.com/profiles/[U:1:jbw-bddv]',
]);
