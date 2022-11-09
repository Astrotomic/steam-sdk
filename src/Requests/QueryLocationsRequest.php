<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\LocationCity;
use Astrotomic\SteamSdk\Data\LocationCountry;
use Astrotomic\SteamSdk\Data\LocationState;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;
use Spatie\LaravelData\DataCollection;

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

    protected function castToDto(SaloonResponse $response): DataCollection
    {
        return new DataCollection(
            dataClass: match (true) {
                ! $this->countrycode && ! $this->statecode => LocationCountry::class,
                $this->countrycode && ! $this->statecode => LocationState::class,
                $this->countrycode && $this->statecode => LocationCity::class,
            },
            items: $response->json() ?? []
        );
    }
}
