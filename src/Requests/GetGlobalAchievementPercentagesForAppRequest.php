<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\AchievementPercentage;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Request\CastDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetGlobalAchievementPercentagesForAppRequest extends Request
{
    use CastDtoFromResponse;

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

    public function createDtoFromResponse(Response $response): DataCollection
    {
        return new DataCollection(AchievementPercentage::class, $response->json('achievementpercentages.achievements'));
    }
}
