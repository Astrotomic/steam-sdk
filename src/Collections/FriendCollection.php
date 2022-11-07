<?php

namespace Astrotomic\SteamSdk\Collections;

use Astrotomic\SteamSdk\Data\Friend;

final class FriendCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return static::make($data)->map(
            fn (array $item): Friend => Friend::fromArray($item)
        );
    }
}
