<?php
declare(strict_types=1);
namespace App\Services;

use App\Services\Traits\SortTrait;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

abstract class AbstractIndexService
{
    use SortTrait;

    /**
     * @var string
     */
    protected string $model;

    /**
     * Get a list of models
     *
     * @param array $data
     *
     * @return Paginator
     */
    public function index(array $data = []): Paginator
    {
        $query = $this->search($data);

        if (Arr::has($data, 'exclude_id')) {
            $query->when(
                Arr::get($data, 'exclude_id'),
                fn ($query) => $query->whereNotIn('id', Arr::get($data, 'exclude_id', []))
            );
            Arr::forget($data, 'exclude_id');
        }

        $this->with($query);
        $this->filter(
            $query,
            Arr::except(
                $data,
                [
                    Config::get("pagination.search_key"),
                    Config::get("pagination.sort_key"),
                    Config::get("pagination.order_key"),
                    Config::get("pagination.limit_key"),
                    Config::get("pagination.page_key")
                ]
            )
        );
        $this->sort(
            $query,
            Arr::only($data, [Config::get("pagination.sort_key"), Config::get("pagination.order_key")]),
        );
        return $this->paginate($query, Arr::only($data, Config::get("pagination.limit_key")));
    }

    /**
     * @return EloquentBuilder
     */
    public function query(): EloquentBuilder
    {
        /**
         * @var Model $model
         */
        $model = App::make($this->model);

        return $model::query();
    }

    /**
     * @param array $data
     *
     * @return EloquentBuilder
     */
    protected function search(array $data): EloquentBuilder
    {
        return $this->query();
    }

    /**
     * @param $query
     * @param array $filter
     *
     * @return EloquentBuilder
     */
    protected function filter($query, array $filter): EloquentBuilder
    {
        $query->when($filter, fn($query) => $this->applyFilter($query, $filter));

        return $query;
    }

    /**
     * @param mixed $query
     * @param array $filter
     *
     * @return mixed
     */
    protected function applyFilter(mixed $query, array $filter): mixed
    {
        foreach ($filter as $filterKey => $filterValue) {
            if (!is_string($filterKey)) {
                continue;
            }

            if (is_array($filterValue)) {
                $query->whereIn($filterKey, $filterValue);
            } else {
                $query->where($filterKey, $filterValue);
            }
        }

        return $query;
    }

    /**
     * @param $query
     * @param array $data
     *
     * @return Paginator
     */
    protected function paginate($query, array $data): Paginator
    {
        $limit = Arr::get($data, Config::get("pagination.limit_key")) ?: Config::get('pagination.limit_per_page');
        return $query->paginate($limit);
    }

    /**
     * @param $query
     *
     * @return EloquentBuilder
     */
    protected function with($query): EloquentBuilder
    {
        return $query;
    }

    /**
     * @return Model
     */
    protected function model(): Model
    {
        return new $this->model();
    }

    /**
     * @param string $sort
     *
     * @return string
     */
    private function prepareMultipleLanguages(string $sort): string
    {
        if (in_array($sort, Config::get('multiple-languages-fields'))) {
            $sort = sprintf('%s_%s', $sort, Config::get('app.locale'));
        }

        return $sort;
    }
}
