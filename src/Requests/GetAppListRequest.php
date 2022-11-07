<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Collections\AppCollection;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class GetAppListRequest extends SaloonRequest
{
    use CastsToDto;

    protected ?string $method = 'GET';

    public function defineEndpoint(): string
    {
        return '/ISteamApps/GetAppList/v2';
    }

    protected function castToDto(SaloonResponse $response): AppCollection
    {
        return AppCollection::fromArray($response->json('applist.apps'));
    }
}
