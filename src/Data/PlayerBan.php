<?php

namespace Astrotomic\SteamSdk\Data;

use Carbon\CarbonImmutable;
use SteamID;

final class PlayerBan extends DataTransferObject
{
    public function __construct(
        public readonly string $steamid,
        public readonly bool $communitybanned,
        public readonly bool $vacbanned,
        public readonly int $numberofvacbans,
        public readonly int $numberofgamebans,
        public readonly int $dayssincelastban,
        public readonly string $economyban,
    ) {
    }

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
