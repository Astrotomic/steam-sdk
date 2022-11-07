<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Collections\PlayerSummaryCollection;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class GetPlayerSummariesRequest extends SaloonRequest
{
    use CastsToDto;

    protected ?string $method = 'GET';

    public function __construct(
        public readonly array|string $steamids,
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/ISteamUser/GetPlayerSummaries/v2';
    }

    public function defaultQuery(): array
    {
        return [
            'steamids' => implode(',', (array) $this->steamids),
        ];
    }

    protected function castToDto(SaloonResponse $response): PlayerSummaryCollection
    {
        return PlayerSummaryCollection::fromArray($response->json('response.players'));
    }
}
