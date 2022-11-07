<?php

namespace Astrotomic\SteamSdk\Data;

final class ApiParameter extends DataTransferObject
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly bool $optional,
        public readonly ?string $description = null,
    ) {
    }
}
