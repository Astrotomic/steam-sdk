<?php

namespace Astrotomic\SteamSdk\Collections;

use Astrotomic\SteamSdk\Data\ApiParameter;

final class ApiParameterCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return static::make($data)->map(
            fn (array $item): ApiParameter => ApiParameter::fromArray($item)
        );
    }
}
