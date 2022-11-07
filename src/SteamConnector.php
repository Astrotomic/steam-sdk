<?php

namespace Astrotomic\SteamSdk;

use Astrotomic\SteamSdk\Collections\AchievementPercentageCollection;
use Astrotomic\SteamSdk\Collections\ApiInterfaceCollection;
use Astrotomic\SteamSdk\Collections\FriendCollection;
use Astrotomic\SteamSdk\Collections\NewsItemCollection;
use Astrotomic\SteamSdk\Collections\PlayerBanCollection;
use Astrotomic\SteamSdk\Collections\PlayerSummaryCollection;
use Astrotomic\SteamSdk\Enums\Relationship;
use Astrotomic\SteamSdk\Requests\GetFriendListRequest;
use Astrotomic\SteamSdk\Requests\GetGlobalAchievementPercentagesForAppRequest;
use Astrotomic\SteamSdk\Requests\GetNewsForAppRequest;
use Astrotomic\SteamSdk\Requests\GetPlayerBansRequest;
use Astrotomic\SteamSdk\Requests\GetPlayerSummariesRequest;
use Astrotomic\SteamSdk\Requests\GetSupportedAPIListRequest;
use Astrotomic\SteamSdk\Requests\QueryLocationsRequest;
use Astrotomic\SteamSdk\Responses\SteamResponse;
use Carbon\CarbonInterface;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
use Sammyjo20\Saloon\Traits\Plugins\AlwaysThrowsOnErrors;

class SteamConnector extends SaloonConnector
{
    use AcceptsJson;
    use AlwaysThrowsOnErrors;

    protected ?string $response = SteamResponse::class;

    public function __construct(
        public readonly ?string $apiKey = null,
    ) {
    }

    public function defineBaseUrl(): string
    {
        return 'https://api.steampowered.com';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'key' => $this->apiKey,
            'format' => 'json',
        ]);
    }

    public function getSupportedApiList(): ApiInterfaceCollection
    {
        return $this->send(
            new GetSupportedAPIListRequest()
        )->dto();
    }

    public function queryLocations(?string $countryCode = null, ?string $stateCode = null): array
    {
        return $this->send(
            new QueryLocationsRequest($countryCode, $stateCode)
        )->json();
    }

    public function getNewsForApp(
        int $appid,
        int|null $maxlength = null,
        CarbonInterface|null $enddate = null,
        int|null $count = null,
        array|null $feeds = null,
        array|null $tags = null,
    ): NewsItemCollection {
        return $this->send(
            new GetNewsForAppRequest($appid, $maxlength, $enddate, $count, $feeds, $tags)
        )->dto();
    }

    public function getGlobalAchievementPercentagesForApp(int $gameid): AchievementPercentageCollection
    {
        return $this->send(
            new GetGlobalAchievementPercentagesForAppRequest($gameid)
        )->dto();
    }

    public function getPlayerSummaries(array|string $steamids): PlayerSummaryCollection
    {
        return $this->send(
            new GetPlayerSummariesRequest($steamids)
        )->dto();
    }

    public function getFriendList(string $steamid, ?Relationship $relationship = null): FriendCollection
    {
        return $this->send(
            new GetFriendListRequest($steamid, $relationship)
        )->dto();
    }

    public function getPlayerBans(array|string $steamids): PlayerBanCollection
    {
        return $this->send(
            new GetPlayerBansRequest($steamids)
        )->dto();
    }
}
