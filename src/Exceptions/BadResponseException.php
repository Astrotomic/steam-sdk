<?php

namespace Astrotomic\SteamSdk\Exceptions;

use Sammyjo20\Saloon\Exceptions\SaloonRequestException;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Throwable;

class BadResponseException extends SaloonRequestException
{
    final public function __construct(SaloonResponse $response, string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($response, $message, $code, $previous);
    }

    public static function fromResponse(SaloonResponse $response): static
    {
        $body = $response->toPsrResponse()->getBody()->getContents();

        return new static($response, $body, $response->status(), $response->getGuzzleException());
    }

    public function getResponse(): SaloonResponse
    {
        return $this->getSaloonResponse();
    }
}
