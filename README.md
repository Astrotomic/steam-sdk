# Steam SDK

[![Latest Version](http://img.shields.io/packagist/v/astrotomic/steam-sdk.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/astrotomic/steam-sdk)
[![MIT License](https://img.shields.io/github/license/Astrotomic/steam-sdk.svg?label=License&color=blue&style=for-the-badge)](https://github.com/Astrotomic/steam-sdk/blob/master/LICENSE.md)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge)](https://forest.astrotomic.info)
[![Larabelles](https://img.shields.io/badge/Larabelles-%F0%9F%A6%84-lightpink?style=for-the-badge)](https://larabelles.com)

[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/steam-sdk.svg?label=Downloads&style=flat-square)](https://packagist.org/packages/astrotomic/steam-sdk)
[![PHP Version](https://img.shields.io/packagist/dependency-v/astrotomic/steam-sdk/php?style=flat-square)](https://packagist.org/packages/astrotomic/steam-sdk)

## Installation

```bash
composer require astrotomic/steam-sdk
```

And you have to define `services.steam.api_key` config with your [Steam API-Key](https://steamcommunity.com/dev/apikey) to use.

## Usage

```php
$steam = app(\Astrotomic\SteamSdk\SteamConnector::class);

$steam->getPlayerSummaries($steamid);
```

## Implemented

|     | Method   | Path                                                           |
|-----|----------|----------------------------------------------------------------|
| ✅   | **GET**  | `ISteamNews/GetNewsForApp/v2`                                  |
| ✅   | **GET**  | `ISteamUser/GetFriendList/v1`                                  |
| ✅   | **GET**  | `ISteamUser/GetPlayerBans/v1`                                  |
| ✅   | **GET**  | `ISteamUser/GetPlayerSummaries/v2`                             |
| ✅   | **GET**  | `ISteamUserStats/GetGlobalAchievementPercentagesForApp/v2`     |
| 🆙  | **GET**  | `ISteamNews/GetNewsForApp/v1`                                  |
| 🆙  | **GET**  | `ISteamUser/GetPlayerSummaries/v1`                             |
| 🆙  | **GET**  | `ISteamUserStats/GetGlobalAchievementPercentagesForApp/v1`     |
| 🛠️ | **GET**  | `ISteamWebAPIUtil/GetSupportedAPIList/v1`                      |
| 🗒️ | **GET**  | `ISteamUser/ResolveVanityURL/v1`                               |
| 🗒️ | **GET**  | `ISteamUserStats/GetGlobalStatsForGame/v1`                     |
| 🗒️ | **GET**  | `ISteamUserStats/GetNumberOfCurrentPlayers/v1`                 |
| 🗒️ | **GET**  | `ISteamUserStats/GetPlayerAchievements/v1`                     |
| 🗒️ | **GET**  | `ISteamUserStats/GetUserStatsForGame/v1`                       |
| 🗒️ | **GET**  | `ISteamUserStats/GetUserStatsForGame/v2`                       |
| ❓️  | **GET**  | `ICSGOPlayers_730/GetNextMatchSharingCode/v1`                  |
| ❓️  | **GET**  | `ICSGOServers_730/GetGameMapsPlaytime/v1`                      |
| ❓️  | **GET**  | `ICSGOServers_730/GetGameServersStatus/v1`                     |
| ❓️  | **GET**  | `ICSGOTournaments_730/GetTournamentFantasyLineup/v1`           |
| ❓️  | **GET**  | `ICSGOTournaments_730/GetTournamentItems/v1`                   |
| ❓️  | **GET**  | `ICSGOTournaments_730/GetTournamentLayout/v1`                  |
| ❓️  | **GET**  | `ICSGOTournaments_730/GetTournamentPredictions/v1`             |
| ❓️  | **GET**  | `IContentServerConfigService/GetSteamCacheNodeParams/v1`       |
| ❓️  | **GET**  | `IContentServerDirectoryService/GetClientUpdateHosts/v1`       |
| ❓️  | **GET**  | `IContentServerDirectoryService/GetDepotPatchInfo/v1`          |
| ❓️  | **GET**  | `IContentServerDirectoryService/GetServersForSteamPipe/v1`     |
| ❓️  | **GET**  | `IDOTA2MatchStats_205790/GetRealtimeStats/v1`                  |
| ❓️  | **GET**  | `IDOTA2MatchStats_570/GetRealtimeStats/v1`                     |
| ❓️  | **GET**  | `IDOTA2Match_205790/GetLiveLeagueGames/v1`                     |
| ❓️  | **GET**  | `IDOTA2Match_205790/GetMatchDetails/v1`                        |
| ❓️  | **GET**  | `IDOTA2Match_205790/GetMatchHistory/v1`                        |
| ❓️  | **GET**  | `IDOTA2Match_205790/GetMatchHistoryBySequenceNum/v1`           |
| ❓️  | **GET**  | `IDOTA2Match_205790/GetTeamInfoByTeamID/v1`                    |
| ❓️  | **GET**  | `IDOTA2Match_205790/GetTopLiveEventGame/v1`                    |
| ❓️  | **GET**  | `IDOTA2Match_205790/GetTopLiveGame/v1`                         |
| ❓️  | **GET**  | `IDOTA2Match_205790/GetTopWeekendTourneyGames/v1`              |
| ❓️  | **GET**  | `IDOTA2Match_205790/GetTournamentPlayerStats/v1`               |
| ❓️  | **GET**  | `IDOTA2Match_205790/GetTournamentPlayerStats/v2`               |
| ❓️  | **GET**  | `IDOTA2Match_570/GetLiveLeagueGames/v1`                        |
| ❓️  | **GET**  | `IDOTA2Match_570/GetMatchDetails/v1`                           |
| ❓️  | **GET**  | `IDOTA2Match_570/GetMatchHistory/v1`                           |
| ❓️  | **GET**  | `IDOTA2Match_570/GetMatchHistoryBySequenceNum/v1`              |
| ❓️  | **GET**  | `IDOTA2Match_570/GetTeamInfoByTeamID/v1`                       |
| ❓️  | **GET**  | `IDOTA2Match_570/GetTopLiveEventGame/v1`                       |
| ❓️  | **GET**  | `IDOTA2Match_570/GetTopLiveGame/v1`                            |
| ❓️  | **GET**  | `IDOTA2Match_570/GetTopWeekendTourneyGames/v1`                 |
| ❓️  | **GET**  | `IDOTA2Match_570/GetTournamentPlayerStats/v1`                  |
| ❓️  | **GET**  | `IDOTA2Match_570/GetTournamentPlayerStats/v2`                  |
| ❓️  | **GET**  | `IDOTA2StreamSystem_205790/GetBroadcasterInfo/v1`              |
| ❓️  | **GET**  | `IDOTA2StreamSystem_570/GetBroadcasterInfo/v1`                 |
| ❓️  | **GET**  | `IDOTA2Ticket_205790/GetSteamIDForBadgeID/v1`                  |
| ❓️  | **GET**  | `IDOTA2Ticket_205790/SteamAccountValidForBadgeType/v1`         |
| ❓️  | **GET**  | `IDOTA2Ticket_570/GetSteamIDForBadgeID/v1`                     |
| ❓️  | **GET**  | `IDOTA2Ticket_570/SteamAccountValidForBadgeType/v1`            |
| ❓️  | **GET**  | `IEconDOTA2_205790/GetEventStatsForAccount/v1`                 |
| ❓️  | **GET**  | `IEconDOTA2_205790/GetGameItems/v1`                            |
| ❓️  | **GET**  | `IEconDOTA2_205790/GetHeroes/v1`                               |
| ❓️  | **GET**  | `IEconDOTA2_205790/GetItemCreators/v1`                         |
| ❓️  | **GET**  | `IEconDOTA2_205790/GetItemWorkshopPublishedFileIDs/v1`         |
| ❓️  | **GET**  | `IEconDOTA2_205790/GetRarities/v1`                             |
| ❓️  | **GET**  | `IEconDOTA2_205790/GetTournamentPrizePool/v1`                  |
| ❓️  | **GET**  | `IEconDOTA2_570/GetEventStatsForAccount/v1`                    |
| ❓️  | **GET**  | `IEconDOTA2_570/GetGameItems/v1`                               |
| ❓️  | **GET**  | `IEconDOTA2_570/GetHeroes/v1`                                  |
| ❓️  | **GET**  | `IEconDOTA2_570/GetItemCreators/v1`                            |
| ❓️  | **GET**  | `IEconDOTA2_570/GetItemWorkshopPublishedFileIDs/v1`            |
| ❓️  | **GET**  | `IEconDOTA2_570/GetRarities/v1`                                |
| ❓️  | **GET**  | `IEconDOTA2_570/GetTournamentPrizePool/v1`                     |
| ❓️  | **GET**  | `IEconItems_1046930/GetPlayerItems/v1`                         |
| ❓️  | **GET**  | `IEconItems_1269260/GetEquippedPlayerItems/v1`                 |
| ❓️  | **GET**  | `IEconItems_205790/GetEquippedPlayerItems/v1`                  |
| ❓️  | **GET**  | `IEconItems_205790/GetPlayerItems/v1`                          |
| ❓️  | **GET**  | `IEconItems_205790/GetStoreMetaData/v1`                        |
| ❓️  | **GET**  | `IEconItems_221540/GetPlayerItems/v1`                          |
| ❓️  | **GET**  | `IEconItems_238460/GetPlayerItems/v1`                          |
| ❓️  | **GET**  | `IEconItems_440/GetPlayerItems/v1`                             |
| ❓️  | **GET**  | `IEconItems_440/GetSchema/v1`                                  |
| ❓️  | **GET**  | `IEconItems_440/GetSchemaItems/v1`                             |
| ❓️  | **GET**  | `IEconItems_440/GetSchemaOverview/v1`                          |
| ❓️  | **GET**  | `IEconItems_440/GetSchemaURL/v1`                               |
| ❓️  | **GET**  | `IEconItems_440/GetStoreMetaData/v1`                           |
| ❓️  | **GET**  | `IEconItems_440/GetStoreStatus/v1`                             |
| ❓️  | **GET**  | `IEconItems_570/GetEquippedPlayerItems/v1`                     |
| ❓️  | **GET**  | `IEconItems_570/GetPlayerItems/v1`                             |
| ❓️  | **GET**  | `IEconItems_570/GetStoreMetaData/v1`                           |
| ❓️  | **GET**  | `IEconItems_583950/GetEquippedPlayerItems/v1`                  |
| ❓️  | **GET**  | `IEconItems_620/GetPlayerItems/v1`                             |
| ❓️  | **GET**  | `IEconItems_620/GetSchema/v1`                                  |
| ❓️  | **GET**  | `IEconItems_730/GetPlayerItems/v1`                             |
| ❓️  | **GET**  | `IEconItems_730/GetSchema/v2`                                  |
| ❓️  | **GET**  | `IEconItems_730/GetSchemaURL/v2`                               |
| ❓️  | **GET**  | `IEconItems_730/GetStoreMetaData/v1`                           |
| ❓️  | **GET**  | `IEconService/GetTradeHistory/v1`                              |
| ❓️  | **GET**  | `IEconService/GetTradeHoldDurations/v1`                        |
| ❓️  | **GET**  | `IEconService/GetTradeOffer/v1`                                |
| ❓️  | **GET**  | `IEconService/GetTradeOffers/v1`                               |
| ❓️  | **GET**  | `IEconService/GetTradeOffersSummary/v1`                        |
| ❓️  | **GET**  | `IEconService/GetTradeStatus/v1`                               |
| ❓️  | **GET**  | `IGCVersion_1046930/GetClientVersion/v1`                       |
| ❓️  | **GET**  | `IGCVersion_1046930/GetServerVersion/v1`                       |
| ❓️  | **GET**  | `IGCVersion_1269260/GetClientVersion/v1`                       |
| ❓️  | **GET**  | `IGCVersion_1269260/GetServerVersion/v1`                       |
| ❓️  | **GET**  | `IGCVersion_205790/GetClientVersion/v1`                        |
| ❓️  | **GET**  | `IGCVersion_205790/GetServerVersion/v1`                        |
| ❓️  | **GET**  | `IGCVersion_440/GetClientVersion/v1`                           |
| ❓️  | **GET**  | `IGCVersion_440/GetServerVersion/v1`                           |
| ❓️  | **GET**  | `IGCVersion_570/GetClientVersion/v1`                           |
| ❓️  | **GET**  | `IGCVersion_570/GetServerVersion/v1`                           |
| ❓️  | **GET**  | `IGCVersion_583950/GetClientVersion/v1`                        |
| ❓️  | **GET**  | `IGCVersion_583950/GetServerVersion/v1`                        |
| ❓️  | **GET**  | `IGCVersion_730/GetServerVersion/v1`                           |
| ❓️  | **GET**  | `IGameServersService/GetAccountList/v1`                        |
| ❓️  | **GET**  | `IGameServersService/GetAccountPublicInfo/v1`                  |
| ❓️  | **GET**  | `IGameServersService/GetServerIPsBySteamID/v1`                 |
| ❓️  | **GET**  | `IGameServersService/GetServerSteamIDsByIP/v1`                 |
| ❓️  | **GET**  | `IGameServersService/QueryByFakeIP/v1`                         |
| ❓️  | **GET**  | `IGameServersService/QueryLoginToken/v1`                       |
| ❓️  | **GET**  | `IInventoryService/GetPriceSheet/v1`                           |
| ❓️  | **GET**  | `IPlayerService/GetBadges/v1`                                  |
| ❓️  | **GET**  | `IPlayerService/GetCommunityBadgeProgress/v1`                  |
| ❓️  | **GET**  | `IPlayerService/GetOwnedGames/v1`                              |
| ❓️  | **GET**  | `IPlayerService/GetRecentlyPlayedGames/v1`                     |
| ❓️  | **GET**  | `IPlayerService/GetSteamLevel/v1`                              |
| ❓️  | **GET**  | `IPlayerService/IsPlayingSharedGame/v1`                        |
| ❓️  | **GET**  | `IPortal2Leaderboards_620/GetBucketizedData/v1`                |
| ❓️  | **GET**  | `IPublishedFileService/GetDetails/v1`                          |
| ❓️  | **GET**  | `IPublishedFileService/GetSubSectionData/v1`                   |
| ❓️  | **GET**  | `IPublishedFileService/GetUserFileCount/v1`                    |
| ❓️  | **GET**  | `IPublishedFileService/GetUserFiles/v1`                        |
| ❓️  | **GET**  | `IPublishedFileService/GetUserVoteSummary/v1`                  |
| ❓️  | **GET**  | `IPublishedFileService/QueryFiles/v1`                          |
| ❓️  | **GET**  | `ISteamApps/GetAppList/v1`                                     |
| ❓️  | **GET**  | `ISteamApps/GetAppList/v2`                                     |
| ❓️  | **GET**  | `ISteamApps/GetSDRConfig/v1`                                   |
| ❓️  | **GET**  | `ISteamApps/GetSDRConfig/v2`                                   |
| ❓️  | **GET**  | `ISteamApps/GetServersAtAddress/v1`                            |
| ❓️  | **GET**  | `ISteamApps/UpToDateCheck/v1`                                  |
| ❓️  | **GET**  | `ISteamBroadcast/ViewerHeartbeat/v1`                           |
| ❓️  | **GET**  | `ISteamDirectory/GetCMList/v1`                                 |
| ❓️  | **GET**  | `ISteamDirectory/GetCMListForConnect/v1`                       |
| ❓️  | **GET**  | `ISteamDirectory/GetSteamPipeDomains/v1`                       |
| ❓️  | **GET**  | `ISteamEconomy/GetAssetClassInfo/v1`                           |
| ❓️  | **GET**  | `ISteamEconomy/GetAssetPrices/v1`                              |
| ❓️  | **GET**  | `ISteamRemoteStorage/GetUGCFileDetails/v1`                     |
| ❓️  | **GET**  | `ISteamUser/GetUserGroupList/v1`                               |
| ❓️  | **GET**  | `ISteamUserAuth/AuthenticateUserTicket/v1`                     |
| ❓️  | **GET**  | `ISteamUserOAuth/GetTokenDetails/v1`                           |
| ❓️  | **GET**  | `ISteamUserStats/GetSchemaForGame/v1`                          |
| ❓️  | **GET**  | `ISteamUserStats/GetSchemaForGame/v2`                          |
| ❓️  | **GET**  | `ISteamWebAPIUtil/GetServerInfo/v1`                            |
| ❓️  | **GET**  | `IStoreService/GetAppList/v1`                                  |
| ❓️  | **GET**  | `ITFItems_440/GetGoldenWrenches/v1`                            |
| ❓️  | **GET**  | `ITFItems_440/GetGoldenWrenches/v2`                            |
| ❓️  | **GET**  | `ITFPromos_440/GetItemID/v1`                                   |
| ❓️  | **GET**  | `ITFPromos_620/GetItemID/v1`                                   |
| ❓️  | **GET**  | `ITFSystem_440/GetWorldStatus/v1`                              |
| ❓️  | **POST** | `IBroadcastService/PostGameDataFrameRTMP/v1`                   |
| ❓️  | **POST** | `ICSGOTournaments_730/UploadTournamentFantasyLineup/v1`        |
| ❓️  | **POST** | `ICSGOTournaments_730/UploadTournamentPredictions/v1`          |
| ❓️  | **POST** | `ICheatReportingService/ReportCheatData/v1`                    |
| ❓️  | **POST** | `IClientStats_1046930/ReportEvent/v1`                          |
| ❓️  | **POST** | `IContentServerConfigService/SetSteamCacheClientFilters/v1`    |
| ❓️  | **POST** | `IContentServerConfigService/SetSteamCachePerformanceStats/v1` |
| ❓️  | **POST** | `IDOTA2Ticket_205790/SetSteamAccountPurchased/v1`              |
| ❓️  | **POST** | `IDOTA2Ticket_570/SetSteamAccountPurchased/v1`                 |
| ❓️  | **POST** | `IGameNotificationsService/UserCreateSession/v1`               |
| ❓️  | **POST** | `IGameNotificationsService/UserDeleteSession/v1`               |
| ❓️  | **POST** | `IGameNotificationsService/UserUpdateSession/v1`               |
| ❓️  | **POST** | `IGameServersService/CreateAccount/v1`                         |
| ❓️  | **POST** | `IGameServersService/DeleteAccount/v1`                         |
| ❓️  | **POST** | `IGameServersService/ResetLoginToken/v1`                       |
| ❓️  | **POST** | `IGameServersService/SetMemo/v1`                               |
| ❓️  | **POST** | `IHelpRequestLogsService/GetApplicationLogDemand/v1`           |
| ❓️  | **POST** | `IHelpRequestLogsService/UploadUserApplicationLog/v1`          |
| ❓️  | **POST** | `IInventoryService/CombineItemStacks/v1`                       |
| ❓️  | **POST** | `IInventoryService/SplitItemStack/v1`                          |
| ❓️  | **POST** | `IPlayerService/RecordOfflinePlaytime/v1`                      |
| ❓️  | **POST** | `ISteamCDN/SetClientFilters/v1`                                |
| ❓️  | **POST** | `ISteamCDN/SetPerformanceStats/v1`                             |
| ❓️  | **POST** | `ISteamRemoteStorage/GetCollectionDetails/v1`                  |
| ❓️  | **POST** | `ISteamRemoteStorage/GetPublishedFileDetails/v1`               |
| ❓️  | **POST** | `ISteamUserAuth/AuthenticateUser/v1`                           |
| ❓️  | **POST** | `ISteamWebUserPresenceOAuth/PollStatus/v1`                     |
| ❓️  | **POST** | `ITFPromos_440/GrantItem/v1`                                   |
| ❓️  | **POST** | `ITFPromos_620/GrantItem/v1`                                   |

## Contributing

Please see [CONTRIBUTING](https://github.com/Astrotomic/.github/blob/master/CONTRIBUTING.md) for details. You could also be interested in [CODE OF CONDUCT](https://github.com/Astrotomic/.github/blob/master/CODE_OF_CONDUCT.md).

### Security

If you discover any security related issues, please check [SECURITY](https://github.com/Astrotomic/.github/blob/master/SECURITY.md) for steps to report it.

## Credits

- [Tom Witkowski](https://github.com/Gummibeer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment I would highly appreciate you buying the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to [plant trees](https://www.bbc.co.uk/news/science-environment-48870920). If you contribute to my forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees at [ecologi.com/astrotomic](https://forest.astrotomic.info)

Read more about Treeware at [treeware.earth](https://treeware.earth)
