<?php

namespace Astrotomic\SteamSdk\Data;

final class App extends DataTransferObject
{
    public function __construct(
        public readonly int $appid,
        public readonly ?string $name,
    ) {
    }
}
