<?php

namespace Astrotomic\SteamSdk\Data;

use Astrotomic\SteamSdk\Enums\CommunityVisibilityState;
use Astrotomic\SteamSdk\Enums\PersonaState;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use SteamID;

final class PlayerSummary extends Data
{
    public function __construct(
        public readonly string $steamid,
        public readonly CommunityVisibilityState $communityvisibilitystate,
        public readonly string $personaname,
        public readonly string $profileurl,
        public readonly string $avatar,
        public readonly string $avatarmedium,
        public readonly string $avatarfull,
        public readonly string $avatarhash,
        public readonly PersonaState $personastate,
        public readonly bool $profilestate = false,
        public readonly string|null $primaryclanid = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'U')]
        public readonly CarbonImmutable|null $timecreated = null,
        public readonly string|null $realname = null,
        public readonly string|null $gameserverip = null,
        public readonly string|null $gameextrainfo = null,
        public readonly string|null $loccountrycode = null,
        public readonly string|null $locstatecode = null,
        public readonly int|null $loccityid = null,
    ) {
    }

    public function steamid(): SteamID
    {
        return new SteamID($this->steamid);
    }
}
