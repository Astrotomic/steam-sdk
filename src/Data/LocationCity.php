<?php

namespace Astrotomic\SteamSdk\Data;

final class LocationCity extends DataTransferObject
{
    public function __construct(
        public readonly string $countrycode,
        public readonly string $statecode,
        public readonly int $cityid,
        public readonly string $cityname,
    ) {
    }
}
