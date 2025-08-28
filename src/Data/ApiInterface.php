<?php

namespace Astrotomic\SteamSdk\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

final class ApiInterface extends Data
{
    public function __construct(
        public readonly string $name,
        #[DataCollectionOf(ApiMethod::class)]
        public readonly DataCollection $methods,
    ) {}
}
