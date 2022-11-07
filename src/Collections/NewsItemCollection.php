<?php

namespace Astrotomic\SteamSdk\Collections;

use Astrotomic\SteamSdk\Data\NewsItem;

final class NewsItemCollection extends Collection
{
    public static function fromArray(array $data): self
    {
        return static::make($data)->map(
            fn (array $item): NewsItem => NewsItem::fromArray($item)
        );
    }
}
