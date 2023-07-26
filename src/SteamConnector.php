<?php

namespace Astrotomic\SteamSdk;

use Astrotomic\SteamSdk\Data\PlayerBan;
use Astrotomic\SteamSdk\Data\PlayerSummary;
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
use Carbon\CarbonInterface;
use InvalidArgumentException;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Spatie\LaravelData\DataCollection;
use SteamID;

class SteamConnector extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;

    public function __construct(
        public readonly ?string $apiKey = null,
    ) {
    }

    public function resolveBaseUrl(): string
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

    /**
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\ApiInterface>
     */
    public function getSupportedApiList(): DataCollection
    {
        return $this->send(
            new GetSupportedApiListRequest()
        )->dto();
    }

    /**
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\LocationCountry|\Astrotomic\SteamSdk\Data\LocationState|\Astrotomic\SteamSdk\Data\LocationCity>
     */
    public function queryLocations(string $countrycode = null, string $statecode = null): DataCollection
    {
        return $this->send(
            new QueryLocationsRequest($countrycode, $statecode)
        )->dto();
    }

    /**
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\NewsItem>
     */
    public function getNewsForApp(
        int $appid,
        int $maxlength = null,
        CarbonInterface $enddate = null,
        int $count = null,
        array $feeds = null,
        array $tags = null,
    ): DataCollection {
        return $this->send(
            new GetNewsForAppRequest($appid, $maxlength, $enddate, $count, $feeds, $tags)
        )->dto();
    }

    /**
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\AchievementPercentage>
     */
    public function getGlobalAchievementPercentagesForApp(int $gameid): DataCollection
    {
        return $this->send(
            new GetGlobalAchievementPercentagesForAppRequest($gameid)
        )->dto();
    }

    /**
     * @param  array<array-key, string>|string  $steamids
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\PlayerSummary>
     */
    public function getPlayerSummaries(array|string $steamids): DataCollection
    {
        return $this->send(
            new GetPlayerSummariesRequest($steamids)
        )->dto();
    }

    public function getPlayerSummary(string $steamid): ?PlayerSummary
    {
        return $this->send(
            new GetPlayerSummariesRequest($steamid)
        )->dto()->toCollection()->firstWhere('steamid', $steamid);
    }

    /**
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\Friend>
     */
    public function getFriendList(string $steamid, Relationship $relationship = null): DataCollection
    {
        return $this->send(
            new GetFriendListRequest($steamid, $relationship)
        )->dto();
    }

    /**
     * @param  array<array-key, string>|string  $steamids
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\PlayerBan>
     */
    public function getPlayerBans(array|string $steamids): DataCollection
    {
        return $this->send(
            new GetPlayerBansRequest($steamids)
        )->dto();
    }

    public function getPlayerBan(string $steamid): ?PlayerBan
    {
        return $this->send(
            new GetPlayerBansRequest($steamid)
        )->dto()->toCollection()->firstWhere('steamid', $steamid);
    }

    /**
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\App>
     */
    public function getAppList(): DataCollection
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
