<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\Friend;
use Astrotomic\SteamSdk\Enums\Relationship;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;
use Spatie\LaravelData\DataCollection;

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
     * @return DataCollection<array-key, Friend>
     */
    public function createDtoFromResponse(Response $response): DataCollection
    {
        return Friend::collection($response->json('friendslist.friends'));
    }
}
