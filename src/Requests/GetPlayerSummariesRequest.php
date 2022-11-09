<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\PlayerSummary;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;
use Spatie\LaravelData\DataCollection;

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

    protected function castToDto(SaloonResponse $response): DataCollection
    {
        return new DataCollection(PlayerSummary::class, $response->json('response.players'));
    }
}
