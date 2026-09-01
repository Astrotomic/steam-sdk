<?php

namespace Astrotomic\SteamSdk\Data;

use Spatie\LaravelData\Data;

final class OwnedApp extends Data
{
    public function __construct(
        public readonly int $appid,
        public readonly ?string $name,
        public readonly int $playtime_forever,
        public readonly ?string $img_icon_url,
        public readonly ?int $playtime_windows_forever,
        public readonly ?int $playtime_mac_forever,
        public readonly ?int $playtime_linux_forever,
        public readonly ?int $playtime_deck_forever,
        public readonly ?int $rtime_last_played,
        public readonly ?string $capsule_filename,
        public readonly ?bool $has_workshop,
        public readonly ?bool $has_market,
        public readonly ?bool $has_dlc,
        public readonly ?int $playtime_disconnected,
    ) {}
}
