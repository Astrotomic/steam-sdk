<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\NewsItem;
use Carbon\CarbonInterface;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Request\CastDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetNewsForAppRequest extends Request
{
    use CastDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly int $appid,
        public readonly ?int $maxlength = null,
        public readonly ?CarbonInterface $enddate = null,
        public readonly ?int $count = null,
        public readonly ?array $feeds = null,
        public readonly ?array $tags = null,
    ) {
    }

    public function resolveEndpoint(): string
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

    public function createDtoFromResponse(Response $response): DataCollection
    {
        return new DataCollection(NewsItem::class, $response->json('appnews.newsitems'));
    }
}
