<?php

it('returns supported api list', function () {
    $response = $this->steam->getSupportedApiList();
    $this->assertIsArray($response);
});
