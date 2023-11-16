<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\ApiInterface;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetSupportedApiListRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/ISteamWebAPIUtil/GetSupportedAPIList/v1';
    }

    /**
     * @return DataCollection<array-key, ApiInterface>
     */
    public function createDtoFromResponse(Response $response): DataCollection
    {
        return ApiInterface::collection($response->json('apilist.interfaces'));
    }
}
