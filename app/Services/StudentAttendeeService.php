<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\StudentAttendance;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class StudentAttendeeService extends AbstractCRUDService
{
    /**
     * @var string
     */
    protected string $model = StudentAttendance::class;

    /**
     * @param $query
     *
     * @return EloquentBuilder
     */
    protected function with($query): EloquentBuilder
    {
        return $query->with(['lesson', 'student', 'studentPackage',]);
    }
}
