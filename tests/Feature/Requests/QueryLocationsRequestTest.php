<?php

it('returns all countries', function () {
    $countries = $this->steam->queryLocations();

    $this->assertNotEmpty($countries);

    foreach ($countries as $country) {
        $this->assertArrayHasKey('countrycode', $country);
        $this->assertIsString($country['countrycode']);
        $this->assertArrayHasKey('hasstates', $country);
        $this->assertIsInt($country['hasstates']);
        $this->assertArrayHasKey('countryname', $country);
        $this->assertIsString($country['countryname']);
    }
})->skip();
