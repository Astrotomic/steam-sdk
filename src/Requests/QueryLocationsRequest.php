<?php

namespace Astrotomic\SteamSdk\Requests;

use Sammyjo20\Saloon\Http\SaloonRequest;

class QueryLocationsRequest extends SaloonRequest
{
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
}
