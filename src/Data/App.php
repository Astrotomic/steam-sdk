<?php

namespace Astrotomic\SteamSdk\Data;

use Spatie\LaravelData\Data;

final class App extends Data
{
    public function __construct(
        public readonly int $appid,
        public readonly ?string $name,
    ) {
    }
}
