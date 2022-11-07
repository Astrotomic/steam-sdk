<?php

use Astrotomic\PhpunitAssertions\NullableTypeAssertions;
use Astrotomic\PhpunitAssertions\UrlAssertions;
use Astrotomic\SteamSdk\Data\NewsItem;
use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns news for app', function (int $appid): void {
    $news = app(SteamConnector::class)->getNewsForApp(appid: $appid);

    Assert::assertContainsOnlyInstancesOf(NewsItem::class, $news);

    $news->each(function (NewsItem $item): void {
        Assert::assertNotEmpty($item->gid);
        Assert::assertNotEmpty($item->title);
        UrlAssertions::assertValidLoose($item->url());
        NullableTypeAssertions::assertIsNullableString($item->author);
        Assert::assertNotEmpty($item->contents);
        Assert::assertNotEmpty($item->feedlabel);
        Assert::assertNotEmpty($item->feedname);
    });
})->with('appids');
