<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Enums\VanityType;
use Saloon\Http\Request;

class ResolveVanityUrlRequest extends Request
{
    protected string $method = 'GET';

    public function __construct(
        public readonly string $vanityurl,
        public readonly VanityType $url_type,
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/ISteamUser/ResolveVanityURL/v1';
    }

    protected function defaultQueryParameters(): array
    {
        return [
            'vanityurl' => $this->vanityurl,
            'url_type' => $this->url_type->value,
        ];
    }
}
