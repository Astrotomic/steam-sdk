<?php

namespace Astrotomic\SteamSdk\Data;

use Spatie\LaravelData\Data;

final class ApiParameter extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly bool $optional,
        public readonly ?string $description = null,
    ) {}
}
