<?php

namespace Astrotomic\SteamSdk\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

final class ApiMethod extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly int $version,
        public readonly string $httpmethod,
        #[DataCollectionOf(ApiParameter::class)]
        public readonly DataCollection $parameters,
    ) {}
}
