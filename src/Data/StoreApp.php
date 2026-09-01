<?php

namespace Astrotomic\SteamSdk\Data;

use Spatie\LaravelData\Data;

final class StoreApp extends Data
{
    public function __construct(
        public readonly int $steam_appid,
        public readonly string $name,
        public readonly string $type,

        public readonly ?int $required_age,
        public readonly ?bool $is_free,
        public readonly ?string $controller_support,

        public readonly ?array $dlc,

        public readonly ?string $detailed_description,
        public readonly ?string $about_the_game,
        public readonly ?string $short_description,
        public readonly ?string $supported_languages,
        public readonly ?string $reviews,

        public readonly ?string $header_image,
        public readonly ?string $capsule_image,
        public readonly ?string $capsule_imagev5,
        public readonly ?string $website,

        public readonly ?array $pc_requirements,
        public readonly ?array $mac_requirements,
        public readonly ?array $linux_requirements,

        public readonly ?string $legal_notice,
        public readonly ?string $ext_user_account_notice,

        public readonly ?array $developers,
        public readonly ?array $publishers,

        public readonly ?array $price_overview,

        public readonly ?array $packages,
        public readonly ?array $package_groups,

        public readonly ?array $platforms,
        public readonly ?array $metacritic,

        public readonly ?array $categories,
        public readonly ?array $genres,

        public readonly ?array $screenshots,
        public readonly ?array $movies,

        public readonly ?array $recommendations,
        public readonly ?array $achievements,
        public readonly ?array $release_date,
        public readonly ?array $support_info,

        public readonly ?string $background,
        public readonly ?string $background_raw,

        public readonly ?array $content_descriptors,

        public readonly ?array $ratings,
    ) {}
}
