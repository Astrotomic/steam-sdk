<?php

namespace Astrotomic\SteamSdk\Data;

use Astrotomic\SteamSdk\Enums\Relationship;
use Carbon\CarbonImmutable;
use SteamID;

final class Friend extends DataTransferObject
{
    public function __construct(
        public readonly string $steamid,
        public readonly Relationship $relationship,
        public readonly CarbonImmutable $friend_since,
    ) {
    }

    public function steamid(): SteamID
    {
        return new SteamID($this->steamid);
    }
}
