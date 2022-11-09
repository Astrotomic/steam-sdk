<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\Friend;
use Astrotomic\SteamSdk\Enums\Relationship;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;
use Spatie\LaravelData\DataCollection;

class GetFriendListRequest extends SaloonRequest
{
    use CastsToDto;

    protected ?string $method = 'GET';

    public function __construct(
        public readonly string $steamid,
        public readonly ?Relationship $relationship = null,
    ) {
    }

    public function defineEndpoint(): string
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

    protected function castToDto(SaloonResponse $response): DataCollection
    {
        return new DataCollection(Friend::class, $response->json('friendslist.friends'));
    }
}
