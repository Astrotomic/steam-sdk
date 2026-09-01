<?php

namespace Astrotomic\SteamSdk;

use Astrotomic\SteamSdk\Data\AchievementPercentage;
use Astrotomic\SteamSdk\Data\ApiInterface;
use Astrotomic\SteamSdk\Data\App;
use Astrotomic\SteamSdk\Data\Friend;
use Astrotomic\SteamSdk\Data\LocationCity;
use Astrotomic\SteamSdk\Data\LocationCountry;
use Astrotomic\SteamSdk\Data\LocationState;
use Astrotomic\SteamSdk\Data\NewsItem;
use Astrotomic\SteamSdk\Data\OwnedApp;
use Astrotomic\SteamSdk\Data\PlayerBan;
use Astrotomic\SteamSdk\Data\PlayerSummary;
use Astrotomic\SteamSdk\Data\RecentlyPlayedApp;
use Astrotomic\SteamSdk\Enums\Relationship;
use Astrotomic\SteamSdk\Enums\VanityType;
use Astrotomic\SteamSdk\Requests\GetAppListRequest;
use Astrotomic\SteamSdk\Requests\GetFriendListRequest;
use Astrotomic\SteamSdk\Requests\GetGlobalAchievementPercentagesForAppRequest;
use Astrotomic\SteamSdk\Requests\GetNewsForAppRequest;
use Astrotomic\SteamSdk\Requests\GetOwnedGamesRequest;
use Astrotomic\SteamSdk\Requests\GetPlayerBansRequest;
use Astrotomic\SteamSdk\Requests\GetPlayerSummariesRequest;
use Astrotomic\SteamSdk\Requests\GetRecentlyPlayedGamesRequest;
use Astrotomic\SteamSdk\Requests\GetSteamLevelRequest;
use Astrotomic\SteamSdk\Requests\GetSupportedApiListRequest;
use Astrotomic\SteamSdk\Requests\QueryLocationsRequest;
use Astrotomic\SteamSdk\Requests\ResolveVanityUrlRequest;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use xPaw\Steam\SteamID;

class SteamConnector extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;

    public function __construct(
        public readonly ?string $apiKey = null,
    ) {}

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
     * @return Collection<array-key, ApiInterface>
     */
    public function getSupportedApiList(): Collection
    {
        return $this->send(
            new GetSupportedApiListRequest
        )->dtoOrFail();
    }

    /**
     * @return Collection<array-key, LocationCountry|LocationState|LocationCity>
     */
    public function queryLocations(?string $countrycode = null, ?string $statecode = null): Collection
    {
        return $this->send(
            new QueryLocationsRequest($countrycode, $statecode)
        )->dtoOrFail();
    }

    /**
     * @return Collection<array-key, NewsItem>
     */
    public function getNewsForApp(
        int $appid,
        ?int $maxlength = null,
        ?CarbonInterface $enddate = null,
        ?int $count = null,
        ?array $feeds = null,
        ?array $tags = null,
    ): Collection {
        return $this->send(
            new GetNewsForAppRequest($appid, $maxlength, $enddate, $count, $feeds, $tags)
        )->dtoOrFail();
    }

    /**
     * @return Collection<array-key, AchievementPercentage>
     */
    public function getGlobalAchievementPercentagesForApp(int $gameid): Collection
    {
        return $this->send(
            new GetGlobalAchievementPercentagesForAppRequest($gameid)
        )->dtoOrFail();
    }

    /**
     * @param  array<array-key, string>|string  $steamids
     * @return Collection<array-key, PlayerSummary>
     */
    public function getPlayerSummaries(array|string $steamids): Collection
    {
        return $this->send(
            new GetPlayerSummariesRequest($steamids)
        )->dtoOrFail();
    }

    public function getPlayerSummary(string $steamid): ?PlayerSummary
    {
        return $this->getPlayerSummaries($steamid)->firstWhere('steamid', $steamid);
    }

    /**
     * @return Collection<array-key, Friend>
     */
    public function getFriendList(string $steamid, ?Relationship $relationship = null): Collection
    {
        return $this->send(
            new GetFriendListRequest($steamid, $relationship)
        )->dtoOrFail();
    }

    /**
     * @param  array<array-key, string>|string  $steamids
     * @return Collection<array-key, PlayerBan>
     */
    public function getPlayerBans(array|string $steamids): Collection
    {
        return $this->send(
            new GetPlayerBansRequest($steamids)
        )->dtoOrFail();
    }

    public function getPlayerBan(string $steamid): ?PlayerBan
    {
        return $this->getPlayerBans($steamid)->firstWhere('steamid', $steamid);
    }

    public function getSteamLevel(string $steamid): int
    {
        return $this->send(
            new GetSteamLevelRequest($steamid)
        )->dtoOrFail();
    }

    /**
     * @return Collection<array-key, OwnedApp>
     */
    public function getOwnedGames(string $steamid,
        ?bool $include_appinfo = null,
        ?bool $include_extended_appinfo = null,
        ?bool $include_played_free_games = null, ): Collection
    {
        return $this->send(
            new GetOwnedGamesRequest(
                $steamid,
                $include_appinfo,
                $include_extended_appinfo,
                $include_played_free_games,
            )
        )->dtoOrFail();
    }

    /**
     * @return Collection<array-key, RecentlyPlayedApp>
     */
    public function getRecentlyPlayedGames(
        string $steamid,
        ?int $count = 0,
    ): Collection {
        return $this->send(
            new GetRecentlyPlayedGamesRequest(
                $steamid,
                $count
            )
        )->dtoOrFail();
    }

    /**
     * @return Collection<array-key, App>
     */
    public function getAppList(): Collection
    {
        return $this->send(
            new GetAppListRequest
        )->dtoOrFail();
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
