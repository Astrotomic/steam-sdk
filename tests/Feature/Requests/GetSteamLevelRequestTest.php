<?php

use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns single player level', function (string $steamid): void {
    $level = app(SteamConnector::class)->getSteamLevel(steamid: $steamid);

    Assert::assertIsInt($level);
    Assert::assertGreaterThanOrEqual(0, $level);
})->with('userids');
