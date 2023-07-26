<?php

use Astrotomic\SteamSdk\Data\LocationCity;
use Astrotomic\SteamSdk\Data\LocationCountry;
use Astrotomic\SteamSdk\Data\LocationState;
use PHPUnit\Framework\Assert;
use Saloon\Exceptions\Request\ClientException;

it('returns all countries', closure: function (): void {
    $countries = $this->steam->queryLocations();

    Assert::assertContainsOnlyInstancesOf(LocationCountry::class, $countries);
});

it('returns country states', closure: function (string $countrycode): void {
    $states = $this->steam->queryLocations(countrycode: $countrycode);

    Assert::assertContainsOnlyInstancesOf(LocationState::class, $states);
})->with('countries.with_states');

it('returns country state cities', closure: function (string $countrycode, string $statecode): void {
    $cities = $this->steam->queryLocations(countrycode: $countrycode, statecode: $statecode);

    Assert::assertContainsOnlyInstancesOf(LocationCity::class, $cities);
})->with('states');

it('throws client exception for countries without states', closure: function (string $countrycode): void {
    $this->steam->queryLocations(countrycode: $countrycode);
})->with('countries.without_states')->throws(ClientException::class);
