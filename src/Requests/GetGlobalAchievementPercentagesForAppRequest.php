<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\AchievementPercentage;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetGlobalAchievementPercentagesForAppRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly int $gameid,
    ) {
    }

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
     * @return DataCollection<array-key, AchievementPercentage>
     */
    public function createDtoFromResponse(Response $response): DataCollection
    {
        return AchievementPercentage::collection($response->json('achievementpercentages.achievements'));
    }
}
