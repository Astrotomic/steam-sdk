<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\App;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class GetAppListRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/ISteamApps/GetAppList/v2';
    }

    /**
     * @return Collection<array-key, App>
     */
    public function createDtoFromResponse(Response $response): Collection
    {
        return new Collection(App::collect($response->json('applist.apps')));
    }
}
