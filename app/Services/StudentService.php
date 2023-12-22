<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class StudentService extends AbstractCRUDService
{
    /**
     * @var string
     */
    protected string $model = Student::class;

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
