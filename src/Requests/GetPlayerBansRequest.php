<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\PlayerBan;
use Saloon\Contracts\Response;
use Saloon\Http\Request;
use Saloon\Traits\Request\CastDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetPlayerBansRequest extends Request
{
    use CastDtoFromResponse;

    protected string $method = 'GET';

    public function __construct(
        public readonly array|string $steamids,
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/ISteamUser/GetPlayerBans/v1';
    }

    protected function defaultQueryParameters(): array
    {
        return [
            'steamids' => implode(',', (array) $this->steamids),
        ];
    }

    public function createDtoFromResponse(Response $response): DataCollection
    {
        return new DataCollection(PlayerBan::class, $response->json('players'));
    }
}
