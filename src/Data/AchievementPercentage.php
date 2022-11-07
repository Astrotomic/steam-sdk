<?php

namespace Astrotomic\SteamSdk\Data;

final class AchievementPercentage extends DataTransferObject
{
    public function __construct(
        public readonly string $name,
        public readonly float $percent,
    ) {
    }
}
