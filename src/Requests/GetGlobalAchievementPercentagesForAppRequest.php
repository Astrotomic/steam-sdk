<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Collections\AchievementPercentageCollection;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class GetGlobalAchievementPercentagesForAppRequest extends SaloonRequest
{
    use CastsToDto;

    protected ?string $method = 'GET';

    public function __construct(
        public readonly int $gameid,
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v2';
    }

    public function defaultQuery(): array
    {
        return [
            'gameid' => $this->gameid,
        ];
    }

    protected function castToDto(SaloonResponse $response): AchievementPercentageCollection
    {
        return AchievementPercentageCollection::fromArray($response->json('achievementpercentages.achievements'));
    }
}
