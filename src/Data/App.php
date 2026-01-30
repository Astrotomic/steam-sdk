<?php

namespace Astrotomic\SteamSdk\Data;

use Spatie\LaravelData\Data;

final class App extends Data
{
    public function __construct(
        public readonly int $appid,
        public readonly ?string $name,
        public readonly ?int $last_modified,
        public readonly ?int $price_change_number,
    ) {}
}
