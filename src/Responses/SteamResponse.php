<?php

namespace Astrotomic\SteamSdk\Responses;

use Astrotomic\SteamSdk\Exceptions\BadGatewayException;
use Astrotomic\SteamSdk\Exceptions\BadResponseException;
use Astrotomic\SteamSdk\Exceptions\ClientException;
use Astrotomic\SteamSdk\Exceptions\ServerException;
use Astrotomic\SteamSdk\Exceptions\UnauthorizedException;
use Sammyjo20\Saloon\Http\SaloonResponse;

class SteamResponse extends SaloonResponse
{
    public function toException(): ?BadResponseException
    {
        return match (true) {
            $this->clientError() => match ($this->status()) {
                401 => UnauthorizedException::fromResponse($this),
                default => ClientException::fromResponse($this),
            },
            $this->serverError() => match ($this->status()) {
                502 => BadGatewayException::fromResponse($this),
                default => ServerException::fromResponse($this),
            },
            $this->failed() => BadResponseException::fromResponse($this),
            default => null,
        };
    }
}
