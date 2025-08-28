<?php

namespace Astrotomic\SteamSdk\Data;

use Spatie\LaravelData\Data;

final class LocationState extends Data
{
    public function __construct(
        public readonly string $countrycode,
        public readonly string $statecode,
        public readonly string $statename,
    ) {}
}
