<?php

namespace Astrotomic\SteamSdk\Data;

final class LocationState extends DataTransferObject
{
    public function __construct(
        public readonly string $countrycode,
        public readonly string $statecode,
        public readonly string $statename,
    ) {
    }
}
