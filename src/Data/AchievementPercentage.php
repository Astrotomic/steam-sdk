<?php

namespace Astrotomic\SteamSdk\Data;

use Spatie\LaravelData\Data;

final class AchievementPercentage extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly float $percent,
    ) {
    }
}
