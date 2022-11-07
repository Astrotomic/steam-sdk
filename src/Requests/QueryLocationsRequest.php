<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Collections\LocationCityCollection;
use Astrotomic\SteamSdk\Collections\LocationCountryCollection;
use Astrotomic\SteamSdk\Collections\LocationStateCollection;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class QueryLocationsRequest extends SaloonRequest
{
    use CastsToDto;

    protected ?string $method = 'GET';

    public function __construct(
        public readonly string|null $countrycode = null,
        public readonly string|null $statecode = null,
    ) {
    }

    public function defineEndpoint(): string
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

    protected function castToDto(SaloonResponse $response): LocationCountryCollection|LocationStateCollection|LocationCityCollection
    {
        if (! $this->countrycode && ! $this->statecode) {
            return LocationCountryCollection::fromArray($response->json() ?? []);
        }

        if ($this->countrycode && ! $this->statecode) {
            return LocationStateCollection::fromArray($response->json() ?? []);
        }

        return LocationCityCollection::fromArray($response->json() ?? []);
    }
}
