<?php

namespace Astrotomic\SteamSdk\Collections;

use Astrotomic\SteamSdk\Data\LocationCity;

final class LocationCityCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return static::make($data)->map(
            fn (array $item): LocationCity => LocationCity::fromArray($item)
        );
    }
}
