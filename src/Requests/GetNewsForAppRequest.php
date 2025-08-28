<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\NewsItem;
use Carbon\CarbonInterface;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Request\CreatesDtoFromResponse;
use Spatie\LaravelData\DataCollection;

class GetNewsForAppRequest extends Request
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly int $appid,
        public readonly ?int $maxlength = null,
        public readonly ?CarbonInterface $enddate = null,
        public readonly ?int $count = null,
        public readonly ?array $feeds = null,
        public readonly ?array $tags = null,
    ) {}

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

    /**
     * @return DataCollection<array-key, NewsItem>
     */
    public function createDtoFromResponse(Response $response): DataCollection
    {
        return NewsItem::collection($response->json('appnews.newsitems'));
    }
}
