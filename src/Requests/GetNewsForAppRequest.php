<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\NewsItem;
use Carbon\CarbonInterface;
use Saloon\Contracts\Response;
use Saloon\Http\Request;
use Saloon\Traits\Request\CastDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetNewsForAppRequest extends Request
{
    use CastDtoFromResponse;

    protected string $method = 'GET';

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

    protected function defaultQueryParameters(): array
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

    public function createDtoFromResponse(Response $response): DataCollection
    {
        return new DataCollection(NewsItem::class, $response->json('appnews.newsitems'));
    }
}
