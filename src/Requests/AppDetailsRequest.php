<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\StoreApp;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class AppDetailsRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly int $appid,
        public readonly ?string $countrycode,
    ) {}

    public function resolveEndpoint(): string
    {
        return 'https://store.steampowered.com/api/appdetails/';
    }

    public function defaultQuery(): array
    {
        return array_filter(
            [
                'appids' => $this->appid, // API no longer supports requesting more than one appid
                'cc' => $this->countrycode,
            ]
        );
    }

    public function createDtoFromResponse(Response $response): StoreApp
    {
        return StoreApp::from($response->json($this->appid.'.data'));
    }
}
