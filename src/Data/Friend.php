<?php

namespace Astrotomic\SteamSdk\Data;

use Astrotomic\SteamSdk\Enums\Relationship;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use xPaw\Steam\SteamID;

final class Friend extends Data
{
    public function __construct(
        public readonly string $steamid,
        public readonly Relationship $relationship,
        #[WithCast(DateTimeInterfaceCast::class, format: 'U')]
        public readonly CarbonImmutable $friend_since,
    ) {}

    public function steamid(): SteamID
    {
        return new SteamID($this->steamid);
    }
}
