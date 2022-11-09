<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\ApiInterface;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;
use Spatie\LaravelData\DataCollection;

class GetSupportedApiListRequest extends SaloonRequest
{
    use CastsToDto;

    protected ?string $method = 'GET';

    public function defineEndpoint(): string
    {
        return '/ISteamWebAPIUtil/GetSupportedAPIList/v1';
    }

    protected function castToDto(SaloonResponse $response): DataCollection
    {
        return new DataCollection(ApiInterface::class, $response->json('apilist.interfaces'));
    }
}
