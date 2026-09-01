<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\RecentlyPlayedApp;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class GetRecentlyPlayedGamesRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly string $steamid,
        public readonly ?int $count,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/IPlayerService/GetRecentlyPlayedGames/v1';
    }

    public function defaultQuery(): array
    {
        return array_filter(
            [
                'steamid' => $this->steamid,
                'count' => $this->count,
            ]
        );
    }

    public function createDtoFromResponse(Response $response): Collection
    {
        $games = $response->json('response.games');
        if ($games !== null) {
            return new Collection(RecentlyPlayedApp::collect($games));
        } else {
            return new Collection;
        }
    }
}
