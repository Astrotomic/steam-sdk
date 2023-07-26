<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\LocationCity;
use Astrotomic\SteamSdk\Data\LocationCountry;
use Astrotomic\SteamSdk\Data\LocationState;
use JsonException;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Request\CastDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class QueryLocationsRequest extends Request
{
    use CastDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly ?string $countrycode = null,
        public readonly ?string $statecode = null,
    ) {
    }

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

    public function createDtoFromResponse(Response $response): DataCollection
    {
        try {
            $items = $response->json() ?? [];
        } catch (JsonException) {
            $items = [];
        }

        return new DataCollection(
            dataClass: match (true) {
                ! $this->countrycode && ! $this->statecode => LocationCountry::class,
                $this->countrycode && ! $this->statecode => LocationState::class,
                $this->countrycode && $this->statecode => LocationCity::class,
            },
            items: $items
        );
    }
}
