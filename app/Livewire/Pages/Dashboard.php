<?php
declare(strict_types=1);
namespace App\Livewire\Pages;

use App\Models\User;
use App\Services\LessonService;
use App\Services\StudentAttendanceService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    private const DEFAULT_LESSON_FEE = 150;

    /**
     * @var mixed
     */
    public mixed $user;

    /**
     * @var mixed
     */
    public mixed $lessons;

    /**
     * @var ?StudentAttendanceService
     */
    private ?StudentAttendanceService $studentAttendanceService = null;

    /**
     * @return void
     */
    public function mount(): void
    {
        $lessonService = new LessonService();
        $this->lessons = $lessonService->getTodayLessons();
        $this->studentAttendanceService = new StudentAttendanceService();
        $this->user = Auth::user();
    }

    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.dashboard');
    }

    /**
     * @param int $lessonId
     *
     * @return void
     */
    public function apply(int $lessonId): void
    {
        $lesson = $this->lessons->first(fn($lesson) => $lesson->id === $lessonId);
        $isApplier = $lesson->group?->students?->pluck('user_id')?->contains($this->user->id);
        $student = $this->user->student;
        $studentPackage = $student->studentPackages()->first();
        if($isApplier) {
            (new StudentAttendanceService())->firstOrCreate([
                'lesson_id' => $lessonId,
                'student_id' => $student->id,
                'student_package_id' => $studentPackage->id,
                'fee' => 150,
                'is_present' => 1,
            ]);
        }
    }
}
