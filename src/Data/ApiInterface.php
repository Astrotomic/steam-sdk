<?php

namespace Astrotomic\SteamSdk\Data;

use Astrotomic\SteamSdk\Collections\ApiMethodCollection;

final class ApiInterface extends DataTransferObject
{
    public function __construct(
        public readonly string $name,
        public readonly ApiMethodCollection $methods,
    ) {
    }
}
