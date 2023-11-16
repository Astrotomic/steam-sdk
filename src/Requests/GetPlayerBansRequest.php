<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\PlayerBan;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetPlayerBansRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly array|string $steamids,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/ISteamUser/GetPlayerBans/v1';
    }

    public function defaultQuery(): array
    {
        return [
            'steamids' => implode(',', (array) $this->steamids),
        ];
    }

    /**
     * @return DataCollection<array-key, PlayerBan>
     */
    public function createDtoFromResponse(Response $response): DataCollection
    {
        return PlayerBan::collection($response->json('players'));
    }
}
