<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\LocationCity;
use Astrotomic\SteamSdk\Data\LocationCountry;
use Astrotomic\SteamSdk\Data\LocationState;
use Illuminate\Support\Collection;
use JsonException;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

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
     * @return Collection<array-key, LocationCountry|LocationState|LocationCity>
     */
    public function createDtoFromResponse(Response $response): Collection
    {
        try {
            $items = $response->json() ?? [];
        } catch (JsonException) {
            $items = [];
        }

        return collect(match (true) {
            ! $this->countrycode && ! $this->statecode => LocationCountry::collect($items),
            $this->countrycode && ! $this->statecode => LocationState::collect($items),
            $this->countrycode && $this->statecode => LocationCity::collect($items),
        });
    }
}
