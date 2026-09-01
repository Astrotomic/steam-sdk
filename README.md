# Steam SDK

[![Latest Version](http://img.shields.io/packagist/v/astrotomic/steam-sdk.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/astrotomic/steam-sdk)
[![MIT License](https://img.shields.io/github/license/Astrotomic/steam-sdk.svg?label=License&color=blue&style=for-the-badge)](https://github.com/Astrotomic/steam-sdk/blob/master/LICENSE.md)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge)](https://forest.astrotomic.info)
[![Larabelles](https://img.shields.io/badge/Larabelles-%F0%9F%A6%84-lightpink?style=for-the-badge)](https://larabelles.com)

[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/steam-sdk.svg?label=Downloads&style=flat-square)](https://packagist.org/packages/astrotomic/steam-sdk)
[![PHP Version](https://img.shields.io/packagist/dependency-v/astrotomic/steam-sdk/php?style=flat-square)](https://packagist.org/packages/astrotomic/steam-sdk)
[![Laravel Version](https://img.shields.io/packagist/dependency-v/astrotomic/steam-sdk/illuminate/support?style=flat-square&label=Laravel)](https://packagist.org/packages/astrotomic/steam-sdk)

Interface with Steam's APIs using PHP.

## Installation

```bash
composer require astrotomic/steam-sdk
```

In your Laravel project's `config/services.php` add your [Steam API key](https://steamcommunity.com/dev/apikey):

```php
<?php

return [
    'steam' => [
        'api_key' => env('STEAM_API_KEY'),
    ],
];
```

## Usage example

```php
$steam = app(\Astrotomic\SteamSdk\SteamConnector::class);

$steam->getPlayerSummaries($steamid);
```

### Implemented requests

| Steam API     | Steam Interface    | Method                                    |
|---------------|--------------------|-------------------------------------------|
| Web API       | `ISteamApps`       | `getAppList()`                            |
| Web API       | `ISteamNews`       | `getNewsForApp()`                         |
| Web API       | `ISteamUser`       | `getFriendList()`                         |
| Web API       | `ISteamUser`       | `getPlayerBans()`                         |
| Web API       | `ISteamUser`       | `getPlayerSummaries()`                    |
| Web API       | `ISteamUser`       | `resolveVanityUrl()`                      |
| Web API       | `IPlayerService`   | `getRecentlyPlayedGames()`                |
| Web API       | `IPlayerService`   | `getSteamLevel()`                         |
| Web API       | `ISteamUserStats`  | `getGlobalAchievementPercentagesForApp()` |
| Web API       | `ISteamWebAPIUtil` | `getSupportedApiList()`                   |
| Community API | ?                  | `queryLocations()`                        |

For more information on Steam's APIs, see:
- https://partner.steamgames.com/doc/webapi
- https://steamapi.xpaw.me/
- https://steamcommunity.com/dev
- https://developer.valvesoftware.com/wiki/Steam_Web_API

## Contributing

See [CONTRIBUTING](https://github.com/Astrotomic/.github/blob/master/CONTRIBUTING.md) for how to contribute.

All contributors must adhere to our [CODE OF CONDUCT](https://github.com/Astrotomic/.github/blob/master/CODE_OF_CONDUCT.md).

Good examples of first contributions are implementing missing requests or fixing bugs.

This project uses [Saloon](https://docs.saloon.dev/) to implement Steam API requests.

### Security

If you discover security issues, follow the steps in [SECURITY](https://github.com/Astrotomic/.github/blob/master/SECURITY.md) to report them.

## Credits

- [Tom Witkowski](https://github.com/Gummibeer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). See [License File](LICENSE.md) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment, I would highly appreciate you buying
the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising
above 1.5C is to [plant trees](https://www.bbc.co.uk/news/science-environment-48870920). If you contribute to my forest,
you’ll be creating employment for local families and
restoring wildlife habitats.

You can buy trees at [ecologi.com/astrotomic](https://forest.astrotomic.info)

Read more about Treeware at [treeware.earth](https://treeware.earth)
