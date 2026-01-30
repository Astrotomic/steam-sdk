<?php

namespace Astrotomic\SteamSdk\Requests;

use Astrotomic\SteamSdk\Data\App;
use Saloon\Enums\Method;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasRequestPagination;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\PaginationPlugin\CursorPaginator;
use Saloon\PaginationPlugin\Paginator;
use Saloon\Traits\Request\CreatesDtoFromResponse;

class GetAppListRequest extends Request implements HasRequestPagination, Paginatable
{
    use CreatesDtoFromResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public readonly ?int $if_modified_since = null,
        public readonly ?bool $include_games = null,
        public readonly ?bool $include_dlc = null,
        public readonly ?bool $include_software = null,
        public readonly ?bool $include_videos = null,
        public readonly ?bool $include_hardware = null,
        public readonly ?string $have_description_language = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/IStoreService/GetAppList/v1';
    }

    public function defaultQuery(): array
    {
        return array_filter([
            'if_modified_since' => $this->if_modified_since,
            'include_games' => $this->include_games,
            'include_dlc' => $this->include_dlc,
            'include_software' => $this->include_software,
            'include_videos' => $this->include_videos,
            'include_hardware' => $this->include_hardware,
            'have_description_language' => $this->have_description_language,
        ]);
    }

    /**
     * @return array<App>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return App::collect($response->json('response.apps'));
    }

    public function paginate(Connector $connector): Paginator
    {
        return new class(connector: $connector, request: $this) extends CursorPaginator
        {
            protected function applyPagination(Request $request): Request
            {
                if ($this->currentResponse instanceof Response) {
                    $request->query()->add('last_appid', $this->getNextCursor($this->currentResponse));
                }

                if (isset($this->perPageLimit)) {
                    $request->query()->add('max_results', $this->perPageLimit);
                }

                return $request;
            }

            protected function getNextCursor(Response $response): int|string
            {
                return $response->json('response.last_appid');
            }

            protected function isLastPage(Response $response): bool
            {
                return is_null($response->json('response.have_more_results'));
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->dtoOrFail();
            }
        };
    }
}
