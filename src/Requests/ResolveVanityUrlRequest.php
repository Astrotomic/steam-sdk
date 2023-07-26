<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Enums\VanityType;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class ResolveVanityUrlRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        public readonly string $vanityurl,
        public readonly VanityType $url_type,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/ISteamUser/ResolveVanityURL/v1';
    }

    public function defaultQuery(): array
    {
        return [
            'vanityurl' => $this->vanityurl,
            'url_type' => $this->url_type->value,
        ];
    }
}
