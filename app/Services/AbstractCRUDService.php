<?php
declare(strict_types=1);
namespace App\Services;

use App\Services\Traits\DestroyTrait;
use App\Services\Traits\UpdateTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class AbstractCRUDService extends AbstractIndexService
{
    use DestroyTrait;
    use UpdateTrait;

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->query()->count();
    }

    /**
     * @param array $data
     *
     * @return Model
     */
    public function store(array $data): Model
    {
        return $this->model::create($data)->refresh();
    }

    /**
     * @param array $data
     *
     * @return Model
     */
    public function firstOrCreate(array $data): Model
    {
        return $this->model::firstOrCreate($data);
    }

    /**
     * @param int $id
     *
     * @return Model
     */
    public function findOrFail(int $id): Model
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @return void
     */
    public function destroyAll()
    {
        in_array(SoftDeletes::class, class_uses($this->query()->getModel()), true) ?
            $this->model::all()->each(fn(Model $model) => $model->delete()) :
            $this->model::truncate();
    }
}
