<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\AchievementPercentage;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class GetGlobalAchievementPercentagesForAppRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly int $gameid,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v2';
    }

    public function defaultQuery(): array
    {
        return [
            'gameid' => $this->gameid,
        ];
    }

    /**
     * @return Collection<array-key, AchievementPercentage>
     */
    public function createDtoFromResponse(Response $response): Collection
    {
        return new Collection(AchievementPercentage::collect($response->json('achievementpercentages.achievements')));
    }
}
