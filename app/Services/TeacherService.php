<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class TeacherService extends AbstractCRUDService
{
    /**
     * @var string
     */
    protected string $model = Teacher::class;

    /**
     * @param $query
     *
     * @return EloquentBuilder
     */
    protected function with($query): EloquentBuilder
    {
        return $query->with(['user',]);
    }
}
