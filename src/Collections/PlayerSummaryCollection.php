<?php

namespace Astrotomic\SteamSdk\Collections;

use Astrotomic\SteamSdk\Data\PlayerSummary;

final class PlayerSummaryCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return static::make($data)->map(
            fn (array $item): PlayerSummary => PlayerSummary::fromArray($item)
        );
    }
}
