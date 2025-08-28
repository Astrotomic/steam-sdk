<?php

namespace Astrotomic\SteamSdk\Data;

use Spatie\LaravelData\Data;

final class LocationCity extends Data
{
    public function __construct(
        public readonly string $countrycode,
        public readonly string $statecode,
        public readonly int $cityid,
        public readonly string $cityname,
    ) {}
}
