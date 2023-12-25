<?php
declare(strict_types=1);
namespace App\Console\Commands;

use App\Models\Lesson;
use App\Services\LessonService;
use Illuminate\Console\Command;

class CalculateSalary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-salary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate salaries for teacher';

    /**
     * Execute the console command.
     */
    public function handle(LessonService $lessonService): void
    {
        $lessons = $lessonService->getFinishedLessons();
        $lessons->each(
                function (Lesson $lesson) use ($lessonService) {
                    $lessonService->calculateLesson($lesson);
                    $this->info("Calculated for lesson:$lesson->name");
                }
            );
        $this->info("Total: {$lessons->count()} lessons");
    }
}
