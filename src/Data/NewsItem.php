<?php

namespace Astrotomic\SteamSdk\Data;

use Carbon\CarbonImmutable;
use Illuminate\Support\HtmlString;

final class NewsItem extends DataTransferObject
{
    public function __construct(
        public readonly int $appid,
        public readonly string $gid,
        public readonly string $title,
        public readonly string $url,
        public readonly bool $is_external_url,
        public readonly null|string $author,
        public readonly string $contents,
        public readonly string $feedlabel,
        public readonly string $feedname,
        public readonly int $feed_type,
        public readonly CarbonImmutable $date,
    ) {
    }

    public function url(): string
    {
        return str_replace(' ', '+', $this->url);
    }

    public function contents(): HtmlString
    {
        return new HtmlString($this->contents);
    }
}
