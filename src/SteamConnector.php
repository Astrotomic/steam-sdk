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
use Astrotomic\SteamSdk\Responses\SteamResponse;
use Carbon\CarbonInterface;
use InvalidArgumentException;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowsOnErrors;
use Spatie\LaravelData\DataCollection;
use SteamID;

class SteamConnector extends Connector
{
    use AcceptsJson;
    use AlwaysThrowsOnErrors;

    protected string $response = SteamResponse::class;

    public function __construct(
        public readonly ?string $apiKey = null,
    ) {
    }

    public function defineBaseUrl(): string
    {
        return 'https://api.steampowered.com';
    }

    protected function defaultQueryParameters(): array
    {
        return array_filter([
            'key' => $this->apiKey,
            'format' => 'json',
        ]);
    }

    /**
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\ApiInterface>
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     * @throws \Sammyjo20\Saloon\Exceptions\SaloonException
     */
    public function getSupportedApiList(): DataCollection
    {
        return $this->send(
            new GetSupportedApiListRequest()
        )->dto();
    }

    /**
     * @param  string|null  $countrycode
     * @param  string|null  $statecode
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\LocationCountry|\Astrotomic\SteamSdk\Data\LocationState|\Astrotomic\SteamSdk\Data\LocationCity>
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     * @throws \Sammyjo20\Saloon\Exceptions\SaloonException
     */
    public function queryLocations(?string $countrycode = null, ?string $statecode = null): DataCollection
    {
        return $this->send(
            new QueryLocationsRequest($countrycode, $statecode)
        )->dto();
    }

    /**
     * @param  int  $appid
     * @param  int|null  $maxlength
     * @param  \Carbon\CarbonInterface|null  $enddate
     * @param  int|null  $count
     * @param  array|null  $feeds
     * @param  array|null  $tags
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\NewsItem>
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     * @throws \Sammyjo20\Saloon\Exceptions\SaloonException
     */
    public function getNewsForApp(
        int $appid,
        int|null $maxlength = null,
        CarbonInterface|null $enddate = null,
        int|null $count = null,
        array|null $feeds = null,
        array|null $tags = null,
    ): DataCollection {
        return $this->send(
            new GetNewsForAppRequest($appid, $maxlength, $enddate, $count, $feeds, $tags)
        )->dto();
    }

    /**
     * @param  int  $gameid
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\AchievementPercentage>
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     * @throws \Sammyjo20\Saloon\Exceptions\SaloonException
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
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     * @throws \Sammyjo20\Saloon\Exceptions\SaloonException
     */
    public function getPlayerSummaries(array|string $steamids): DataCollection
    {
        return $this->send(
            new GetPlayerSummariesRequest($steamids)
        )->dto();
    }

    /**
     * @param  string  $steamid
     * @return \Astrotomic\SteamSdk\Data\PlayerSummary|null
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     * @throws \Sammyjo20\Saloon\Exceptions\SaloonException
     */
    public function getPlayerSummary(string $steamid): ?PlayerSummary
    {
        return $this->send(
            new GetPlayerSummariesRequest($steamid)
        )->dto()->toCollection()->firstWhere('steamid', $steamid);
    }

    /**
     * @param  string  $steamid
     * @param  \Astrotomic\SteamSdk\Enums\Relationship|null  $relationship
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\Friend>
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     * @throws \Sammyjo20\Saloon\Exceptions\SaloonException
     */
    public function getFriendList(string $steamid, ?Relationship $relationship = null): DataCollection
    {
        return $this->send(
            new GetFriendListRequest($steamid, $relationship)
        )->dto();
    }

    /**
     * @param  array<array-key, string>|string  $steamids
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\PlayerBan>
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     * @throws \Sammyjo20\Saloon\Exceptions\SaloonException
     */
    public function getPlayerBans(array|string $steamids): DataCollection
    {
        return $this->send(
            new GetPlayerBansRequest($steamids)
        )->dto();
    }

    /**
     * @param  string  $steamid
     * @return \Astrotomic\SteamSdk\Data\PlayerBan|null
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     * @throws \Sammyjo20\Saloon\Exceptions\SaloonException
     */
    public function getPlayerBan(string $steamid): ?PlayerBan
    {
        return $this->send(
            new GetPlayerBansRequest($steamid)
        )->dto()->toCollection()->firstWhere('steamid', $steamid);
    }

    /**
     * @return \Spatie\LaravelData\DataCollection<array-key, \Astrotomic\SteamSdk\Data\App>
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     * @throws \Sammyjo20\Saloon\Exceptions\SaloonException
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
