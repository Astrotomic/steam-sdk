<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\LocationCity;
use Astrotomic\SteamSdk\Data\LocationCountry;
use Astrotomic\SteamSdk\Data\LocationState;
use JsonException;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class QueryLocationsRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly ?string $countrycode = null,
        public readonly ?string $statecode = null,
    ) {}

    public function resolveEndpoint(): string
    {
        $query = '';

        if ($this->countrycode) {
            $query .= "/{$this->countrycode}";

            if ($this->statecode) {
                $query .= "/{$this->statecode}";
            }
        }

        return "https://steamcommunity.com/actions/QueryLocations{$query}";
    }

    /**
     * @return DataCollection<array-key, LocationCountry|LocationState|LocationCity>
     */
    public function createDtoFromResponse(Response $response): DataCollection
    {
        try {
            $items = $response->json() ?? [];
        } catch (JsonException) {
            $items = [];
        }

        return match (true) {
            ! $this->countrycode && ! $this->statecode => LocationCountry::collection($items),
            $this->countrycode && ! $this->statecode => LocationState::collection($items),
            $this->countrycode && $this->statecode => LocationCity::collection($items),
        };
    }
}
