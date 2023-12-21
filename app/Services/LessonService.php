<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class LessonService extends AbstractCRUDService
{
    /**
     * @var string
     */
    protected string $model = Lesson::class;

    protected function with($query): EloquentBuilder
    {
        return $query->with(['group.course', 'creator']);
    }
}
