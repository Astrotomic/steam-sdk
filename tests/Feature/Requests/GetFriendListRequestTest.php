<?php

use Astrotomic\SteamSdk\Data\Friend;
use Astrotomic\SteamSdk\Enums\Relationship;
use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns friend list', function (string $steamid, Relationship $relationship): void {
    $friends = app(SteamConnector::class)->getFriendList(steamid: $steamid, relationship: $relationship);

    Assert::assertContainsOnlyInstancesOf(Friend::class, $friends);
})->with('userids')->with([
    Relationship::Friend,
    Relationship::All,
]);
