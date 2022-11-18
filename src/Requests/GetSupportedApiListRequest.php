<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\ApiInterface;
use Saloon\Contracts\Response;
use Saloon\Http\Request;
use Saloon\Traits\Request\CastDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetSupportedApiListRequest extends Request
{
    use CastDtoFromResponse;

    protected string $method = 'GET';

    public function defineEndpoint(): string
    {
        return '/ISteamWebAPIUtil/GetSupportedAPIList/v1';
    }

    public function createDtoFromResponse(Response $response): DataCollection
    {
        return new DataCollection(ApiInterface::class, $response->json('apilist.interfaces'));
    }
}
