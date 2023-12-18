<?php
declare(strict_types=1);
namespace App\Services\Traits;

use Illuminate\Database\Eloquent\Model;
use Throwable;

trait UpdateTrait
{
    /**
     * Update and refresh model
     *
     * @param Model $model
     * @param array $data
     *
     * @return Model
     */
    public function update(Model $model, array $data): Model
    {
        $model->fill($data)->save();
        return $model->refresh();
    }

    /**
     * @param Model $model
     * @param array $data
     *
     * @return Model
     * @throws Throwable
     */
    public function updateOrFail(Model $model, array $data): Model
    {
        $model->updateOrFail($data);
        return $model;
    }
}
