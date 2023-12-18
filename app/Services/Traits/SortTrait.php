<?php
declare(strict_types=1);
namespace App\Services\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

trait SortTrait
{
    /**
     * @param $query
     * @param array $data
     *
     * @return Builder
     */
    protected function sort($query, array $data): Builder
    {
        $sort = $this->getSortColumn($data);
        $order = $this->getDirectionColumn($data);
        $query->when($sort, function ($query) use ($sort, $order) {
            return $query->orderBy($sort, $order);
        });

        return $query;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    protected function getSortColumn(array $data): string
    {
        return Arr::get($data, Config::get("pagination.sort_key"), Config::get("pagination.default_field"));
    }

    /**
     * @param array $data
     *
     * @return string
     */
    protected function getDirectionColumn(array $data): string
    {
        return Arr::get($data, Config::get("pagination.order_key"), Config::get("pagination.order_direction"));
    }
}
