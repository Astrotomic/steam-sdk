<?php

use Astrotomic\SteamSdk\Data\AchievementPercentage;
use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns global achievement percentages for game', function (int $gameid): void {
    $achievements = app(SteamConnector::class)->getGlobalAchievementPercentagesForApp(gameid: $gameid);

    Assert::assertContainsOnlyInstancesOf(AchievementPercentage::class, $achievements);

    $achievements->each(function (AchievementPercentage $achievement): void {
        Assert::assertNotEmpty($achievement->name);
        Assert::assertGreaterThanOrEqual(0, $achievement->percent);
        Assert::assertLessThanOrEqual(100, $achievement->percent);
    });
})->with('appids');
