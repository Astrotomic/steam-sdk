<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\PlayerSummary;
use Saloon\Contracts\Response;
use Saloon\Http\Request;
use Saloon\Traits\Request\CastDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetPlayerSummariesRequest extends Request
{
    use CastDtoFromResponse;

    protected string $method = 'GET';

    public function __construct(
        public readonly array|string $steamids,
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/ISteamUser/GetPlayerSummaries/v2';
    }

    protected function defaultQueryParameters(): array
    {
        return [
            'steamids' => implode(',', (array) $this->steamids),
        ];
    }

    public function createDtoFromResponse(Response $response): DataCollection
    {
        return new DataCollection(PlayerSummary::class, $response->json('response.players'));
    }
}
