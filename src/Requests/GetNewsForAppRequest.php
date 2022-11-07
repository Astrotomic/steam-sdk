<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Collections\NewsItemCollection;
use Carbon\CarbonInterface;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class GetNewsForAppRequest extends SaloonRequest
{
    use CastsToDto;

    protected ?string $method = 'GET';

    public function __construct(
        public readonly int $appid,
        public readonly int|null $maxlength = null,
        public readonly CarbonInterface|null $enddate = null,
        public readonly int|null $count = null,
        public readonly array|null $feeds = null,
        public readonly array|null $tags = null,
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/ISteamNews/GetNewsForApp/v2';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'appid' => $this->appid,
            'maxlength' => $this->maxlength,
            'enddate' => $this->enddate?->timestamp,
            'count' => $this->count,
            'tags' => $this->tags ? implode(',', $this->tags) : null,
            'feeds' => $this->feeds ? implode(',', $this->feeds) : null,
        ]);
    }

    protected function castToDto(SaloonResponse $response): NewsItemCollection
    {
        return NewsItemCollection::fromArray($response->json('appnews.newsitems'));
    }
}
