<?php

use Astrotomic\SteamSdk\Data\LocationCity;
use Astrotomic\SteamSdk\Data\LocationCountry;
use Astrotomic\SteamSdk\Data\LocationState;
use Astrotomic\SteamSdk\Exceptions\ClientException;
use Astrotomic\SteamSdk\SteamConnector;
use PHPUnit\Framework\Assert;

it('returns all countries', closure: function (): void {
    $countries = app(SteamConnector::class)->queryLocations();

    Assert::assertContainsOnlyInstancesOf(LocationCountry::class, $countries);
})->skip();

it('returns country states', closure: function (string $countrycode): void {
    $states = app(SteamConnector::class)->queryLocations(countrycode: $countrycode);

    Assert::assertContainsOnlyInstancesOf(LocationState::class, $states);
})->with('countries.with_states')->skip();

it('returns country state cities', closure: function (string $countrycode, string $statecode): void {
    $cities = app(SteamConnector::class)->queryLocations(countrycode: $countrycode, statecode: $statecode);

    Assert::assertContainsOnlyInstancesOf(LocationCity::class, $cities);
})->with('states')->skip();

it('throws client exception for countries without states', closure: function (string $countrycode): void {
    app(SteamConnector::class)->queryLocations(countrycode: $countrycode);
})->with('countries.without_states')->throws(ClientException::class)->skip();
