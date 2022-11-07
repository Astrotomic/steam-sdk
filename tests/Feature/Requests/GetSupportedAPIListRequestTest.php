<?php

use Astrotomic\SteamSdk\Data\ApiInterface;
use Astrotomic\SteamSdk\Data\ApiMethod;
use Astrotomic\SteamSdk\Data\ApiParameter;
use PHPUnit\Framework\Assert;

it('returns supported api list', function () {
    $interfaces = $this->steam->getSupportedApiList();

    Assert::assertContainsOnlyInstancesOf(ApiInterface::class, $interfaces);

    $interfaces->each(function (ApiInterface $interface): void {
        Assert::assertContainsOnlyInstancesOf(ApiMethod::class, $interface->methods);

        $interface->methods->each(function (ApiMethod $method): void {
            Assert::assertContainsOnlyInstancesOf(ApiParameter::class, $method->parameters);
        });
    });
});
