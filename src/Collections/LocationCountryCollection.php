<?php

namespace Astrotomic\SteamSdk\Collections;

use Astrotomic\SteamSdk\Data\LocationCountry;

final class LocationCountryCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return static::make($data)->map(
            fn (array $item): LocationCountry => LocationCountry::fromArray($item)
        );
    }
}
