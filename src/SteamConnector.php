<?php

namespace Astrotomic\SteamSdk;

use Astrotomic\SteamSdk\Collections\AchievementPercentageCollection;
use Astrotomic\SteamSdk\Collections\ApiInterfaceCollection;
use Astrotomic\SteamSdk\Collections\AppCollection;
use Astrotomic\SteamSdk\Collections\FriendCollection;
use Astrotomic\SteamSdk\Collections\LocationCityCollection;
use Astrotomic\SteamSdk\Collections\LocationCountryCollection;
use Astrotomic\SteamSdk\Collections\LocationStateCollection;
use Astrotomic\SteamSdk\Collections\NewsItemCollection;
use Astrotomic\SteamSdk\Collections\PlayerBanCollection;
use Astrotomic\SteamSdk\Collections\PlayerSummaryCollection;
use Astrotomic\SteamSdk\Enums\Relationship;
use Astrotomic\SteamSdk\Enums\VanityType;
use Astrotomic\SteamSdk\Requests\GetAppListRequest;
use Astrotomic\SteamSdk\Requests\GetFriendListRequest;
use Astrotomic\SteamSdk\Requests\GetGlobalAchievementPercentagesForAppRequest;
use Astrotomic\SteamSdk\Requests\GetNewsForAppRequest;
use Astrotomic\SteamSdk\Requests\GetPlayerBansRequest;
use Astrotomic\SteamSdk\Requests\GetPlayerSummariesRequest;
use Astrotomic\SteamSdk\Requests\GetSupportedApiListRequest;
use Astrotomic\SteamSdk\Requests\QueryLocationsRequest;
use Astrotomic\SteamSdk\Requests\ResolveVanityUrlRequest;
use Astrotomic\SteamSdk\Responses\SteamResponse;
use Carbon\CarbonInterface;
use InvalidArgumentException;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
use Sammyjo20\Saloon\Traits\Plugins\AlwaysThrowsOnErrors;
use SteamID;

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
            new GetSupportedApiListRequest()
        )->dto();
    }

    public function queryLocations(
        ?string $countrycode = null,
        ?string $statecode = null
    ): LocationCountryCollection|LocationStateCollection|LocationCityCollection {
        return $this->send(
            new QueryLocationsRequest($countrycode, $statecode)
        )->dto();
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

    public function getAppList(): AppCollection
    {
        return $this->send(
            new GetAppListRequest()
        )->dto();
    }

    public function resolveVanityUrl(string $vanityurl): ?SteamID
    {
        try {
            return SteamID::SetFromURL($vanityurl, function (string $vanityurl, int $type): ?string {
                return $this->send(
                    new ResolveVanityUrlRequest($vanityurl, VanityType::from($type))
                )->json('response.steamid');
            });
        } catch (InvalidArgumentException) {
            return null;
        }
    }
}
