<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\OwnedApp;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class GetOwnedGamesRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly string $steamid,
        public readonly ?bool $include_appinfo = null,
        public readonly ?bool $include_extended_appinfo = null,
        public readonly ?bool $include_played_free_games = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/IPlayerService/GetOwnedGames/v1';
    }

    public function defaultQuery(): array
    {
        return array_filter(
            [
                'steamid' => $this->steamid,
                'include_appinfo' => $this->include_appinfo,
                'include_extended_appinfo' => $this->include_extended_appinfo,
                'include_played_free_games' => $this->include_played_free_games,
            ],
            fn($value) => $value !== null
        );
    }

    public function createDtoFromResponse(Response $response): Collection
    {
        return new Collection(OwnedApp::collect($response->json('response.games')));
    }
}
