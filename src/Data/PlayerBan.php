<?php

namespace Astrotomic\SteamSdk\Data;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use xPaw\Steam\SteamID;

final class PlayerBan extends Data
{
    public function __construct(
        #[MapInputName('SteamId')]
        public readonly string $steamid,
        #[MapInputName('CommunityBanned')]
        public readonly bool $communitybanned,
        #[MapInputName('VACBanned')]
        public readonly bool $vacbanned,
        #[MapInputName('NumberOfVACBans')]
        public readonly int $numberofvacbans,
        #[MapInputName('NumberOfGameBans')]
        public readonly int $numberofgamebans,
        #[MapInputName('DaysSinceLastBan')]
        public readonly int $dayssincelastban,
        #[MapInputName('EconomyBan')]
        public readonly string $economyban,
    ) {}

    public function steamid(): SteamID
    {
        return new SteamID($this->steamid);
    }

    public function isBanned(): bool
    {
        return $this->communitybanned || $this->vacbanned;
    }

    public function lastBannedAt(): ?CarbonImmutable
    {
        if (! $this->isBanned()) {
            return null;
        }

        return CarbonImmutable::now()->subDays($this->dayssincelastban);
    }
}
