<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\App;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetAppListRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/ISteamApps/GetAppList/v2';
    }

    /**
     * @return DataCollection<array-key, App>
     */
    public function createDtoFromResponse(Response $response): DataCollection
    {
        return App::collection($response->json('applist.apps'));
    }
}
