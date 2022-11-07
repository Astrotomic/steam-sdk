<?php

namespace Astrotomic\SteamSdk\Collections;

use Astrotomic\SteamSdk\Data\AchievementPercentage;

final class AchievementPercentageCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return static::make($data)->map(
            fn (array $item): AchievementPercentage => AchievementPercentage::fromArray($item)
        );
    }
}
