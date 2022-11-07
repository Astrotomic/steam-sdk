<?php

namespace Astrotomic\SteamSdk\Requests;

use Sammyjo20\Saloon\Http\SaloonRequest;

class GetSupportedAPIListRequest extends SaloonRequest
{
    protected ?string $method = 'GET';

    public function defineEndpoint(): string
    {
        return '/ISteamWebAPIUtil/GetSupportedAPIList/v1';
    }
}
