<?php

namespace Astrotomic\SteamSdk\Data;

final class LocationCountry extends DataTransferObject
{
    public function __construct(
        public readonly string $countrycode,
        public readonly string $countryname,
        public readonly bool $hasstates,
    ) {
    }
}
