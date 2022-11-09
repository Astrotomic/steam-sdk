<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\App;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;
use Spatie\LaravelData\DataCollection;

class GetAppListRequest extends SaloonRequest
{
    use CastsToDto;

    protected ?string $method = 'GET';

    public function defineEndpoint(): string
    {
        return '/ISteamApps/GetAppList/v2';
    }

    protected function castToDto(SaloonResponse $response): DataCollection
    {
        return new DataCollection(App::class, $response->json('applist.apps'));
    }
}
