<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Lesson;
use App\Models\LessonTeacherSalary;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class LessonService extends AbstractCRUDService
{
    /**
     * @var string
     */
    protected string $model = Lesson::class;

    /**
     * @return Collection
     */
    public function getTodayLessons(): Collection
    {
        return $this->query()
            ->whereDate('date', Carbon::today())
            ->get();
    }

    /**
     * @param Lesson $lesson
     *
     * @return void
     */
    public function calculateLesson(Lesson $lesson): void
    {
        // TODO: implement whole flow to reduce students balance
        LessonTeacherSalary::firstOrCreate([
            'lesson_id' => $lesson->id,
            'teacher_id' => $lesson->teacher->id,
            'salary' => 400,
        ]);

    }

    /**
     * @return Collection
     */
    public function getFinishedLessons(): Collection
    {
        return $this->query()
            ->whereDate('date', Carbon::yesterday()->format('Y-m-d'))
            ->get();
    }

    protected function with($query): EloquentBuilder
    {
        return $query->with(['group.course', 'creator', 'group.teachers', 'group.students', 'studentAttendances.student',]);
    }
}
