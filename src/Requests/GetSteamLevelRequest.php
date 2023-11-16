<?php

namespace Astrotomic\SteamSdk\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class GetSteamLevelRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly string $steamid,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/IPlayerService/GetSteamLevel/v1';
    }

    public function defaultQuery(): array
    {
        return [
            'steamid' => $this->steamid,
        ];
    }

    public function createDtoFromResponse(Response $response): int
    {
        return (int) $response->json('response.player_level');
    }
}
