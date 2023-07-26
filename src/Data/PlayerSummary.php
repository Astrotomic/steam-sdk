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
        public readonly ?string $primaryclanid = null,
        #[WithCast(DateTimeInterfaceCast::class, format: 'U')]
        public readonly ?CarbonImmutable $timecreated = null,
        public readonly ?string $realname = null,
        public readonly ?string $gameserverip = null,
        public readonly ?string $gameextrainfo = null,
        public readonly ?string $loccountrycode = null,
        public readonly ?string $locstatecode = null,
        public readonly ?int $loccityid = null,
    ) {
    }

    public function steamid(): SteamID
    {
        return new SteamID($this->steamid);
    }
}
