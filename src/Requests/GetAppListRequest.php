<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\App;
use Saloon\Contracts\Response;
use Saloon\Http\Request;
use Saloon\Traits\Request\CastDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetAppListRequest extends Request
{
    use CastDtoFromResponse;

    protected string $method = 'GET';

    public function defineEndpoint(): string
    {
        return '/ISteamApps/GetAppList/v2';
    }

    public function createDtoFromResponse(Response $response): DataCollection
    {
        return new DataCollection(App::class, $response->json('applist.apps'));
    }
}
