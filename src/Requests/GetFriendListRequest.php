<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\Friend;
use Astrotomic\SteamSdk\Enums\Relationship;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class GetFriendListRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly string $steamid,
        public readonly ?Relationship $relationship = null,
    ) {}

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

    /**
     * @return Collection<array-key, Friend>
     */
    public function createDtoFromResponse(Response $response): Collection
    {
        return new Collection(Friend::collect($response->json('friendslist.friends')));
    }
}
