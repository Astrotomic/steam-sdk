<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\Friend;
use Astrotomic\SteamSdk\Enums\Relationship;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Request\CastDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetFriendListRequest extends Request
{
    use CastDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly string $steamid,
        public readonly ?Relationship $relationship = null,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/ISteamUser/GetFriendList/v1';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'steamid' => $this->steamid,
            'relationship' => $this->relationship?->value,
        ]);
    }

    public function createDtoFromResponse(Response $response): DataCollection
    {
        return new DataCollection(Friend::class, $response->json('friendslist.friends'));
    }
}
