<?php

namespace Astrotomic\SteamSdk\Collections;

use Astrotomic\SteamSdk\Data\PlayerBan;

final class PlayerBanCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return static::make($data)->map(
            fn (array $item): PlayerBan => PlayerBan::fromArray($item)
        );
    }
}
