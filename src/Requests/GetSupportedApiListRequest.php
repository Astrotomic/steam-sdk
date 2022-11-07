<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Collections\ApiInterfaceCollection;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class GetSupportedApiListRequest extends SaloonRequest
{
    use CastsToDto;

    protected ?string $method = 'GET';

    public function defineEndpoint(): string
    {
        return '/ISteamWebAPIUtil/GetSupportedAPIList/v1';
    }

    protected function castToDto(SaloonResponse $response): ApiInterfaceCollection
    {
        return ApiInterfaceCollection::fromArray($response->json('apilist.interfaces'));
    }
}
