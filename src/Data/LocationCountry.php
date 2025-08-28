<?php

namespace Astrotomic\SteamSdk\Data;

use Spatie\LaravelData\Data;

final class LocationCountry extends Data
{
    public function __construct(
        public readonly string $countrycode,
        public readonly string $countryname,
        public readonly bool $hasstates,
    ) {}
}
