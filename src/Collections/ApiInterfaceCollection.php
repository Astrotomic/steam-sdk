<?php

namespace Astrotomic\SteamSdk\Collections;

use Astrotomic\SteamSdk\Data\ApiInterface;

final class ApiInterfaceCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return static::make($data)->map(
            fn (array $item): ApiInterface => ApiInterface::fromArray($item)
        );
    }
}
