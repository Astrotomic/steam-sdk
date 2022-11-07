<?php

use Astrotomic\PhpunitAssertions\UrlAssertions;
use Astrotomic\SteamSdk\Data\PlayerSummary;
use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns player summaries', function (string $steamid): void {
    $players = app(SteamConnector::class)->getPlayerSummaries(steamids: $steamid);

    Assert::assertContainsOnlyInstancesOf(PlayerSummary::class, $players);

    $players->each(function (PlayerSummary $player): void {
        Assert::assertSame($player->steamid, $player->steamid()->ConvertToUInt64());
        UrlAssertions::assertValidLoose($player->profileurl);
        UrlAssertions::assertValidLoose($player->avatar);
        UrlAssertions::assertValidLoose($player->avatarmedium);
        UrlAssertions::assertValidLoose($player->avatarfull);
    });
})->with('userids');
