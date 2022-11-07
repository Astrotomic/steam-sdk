<?php

namespace Astrotomic\SteamSdk\Data;

use Astrotomic\SteamSdk\Collections\ApiParameterCollection;

final class ApiMethod extends DataTransferObject
{
    public function __construct(
        public readonly string $name,
        public readonly int $version,
        public readonly string $httpmethod,
        public readonly ApiParameterCollection $parameters,
    ) {
    }
}
