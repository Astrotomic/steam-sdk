<?php

namespace Astrotomic\SteamSdk\Collections;

use Astrotomic\SteamSdk\Data\ApiMethod;

final class ApiMethodCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return static::make($data)->map(
            fn (array $item): ApiMethod => ApiMethod::fromArray($item)
        );
    }
}
