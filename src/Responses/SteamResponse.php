<?php

namespace Astrotomic\SteamSdk\Responses;

use Astrotomic\SteamSdk\Exceptions\BadGatewayException;
use Astrotomic\SteamSdk\Exceptions\BadResponseException;
use Astrotomic\SteamSdk\Exceptions\ClientException;
use Astrotomic\SteamSdk\Exceptions\ServerException;
use Saloon\Http\Responses\Response;

class SteamResponse extends Response
{
    public function toException(): ?BadResponseException
    {
        return match (true) {
            $this->clientError() => ClientException::fromResponse($this),
            $this->serverError() => match ($this->status()) {
                502 => BadGatewayException::fromResponse($this),
                default => ServerException::fromResponse($this),
            },
            $this->failed() => BadResponseException::fromResponse($this),
            default => null,
        };
    }
}
