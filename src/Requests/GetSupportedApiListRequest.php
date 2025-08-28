<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\ApiInterface;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class GetSupportedApiListRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/ISteamWebAPIUtil/GetSupportedAPIList/v1';
    }

    /**
     * @return Collection<array-key, ApiInterface>
     */
    public function createDtoFromResponse(Response $response): Collection
    {
        return new Collection(ApiInterface::collect($response->json('apilist.interfaces')));
    }
}
