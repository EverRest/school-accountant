<?php
declare(strict_types=1);
namespace App\Services\Traits;

use Illuminate\Database\Eloquent\Model;
use Throwable;

/**
 * @codeCoverageIgnore
 */
trait DestroyTrait
{
    /**
     * Delete the model from the database within a transaction.
     *
     * @param Model $model
     * @param bool $force
     *
     * @return Model
     * @throws Throwable
     */
    public function destroy(Model $model, bool $force = false): Model
    {
        if ($force) {
            $model->forceDelete();
        } else {
            $model->deleteOrFail();
        }
        return $model;
    }
}
