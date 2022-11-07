<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Enums\VanityType;
use Sammyjo20\Saloon\Http\SaloonRequest;

class ResolveVanityUrlRequest extends SaloonRequest
{
    protected ?string $method = 'GET';

    public function __construct(
        public readonly string $vanityurl,
        public readonly VanityType $url_type,
    ) {
    }

    public function defineEndpoint(): string
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
