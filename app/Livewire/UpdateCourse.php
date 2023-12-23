<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class UpdateCourse extends Component
{
    /**
     * @var ?Course
     */
    public ?Course $course = null;

    /**
     * @var string
     */
    public string $name = '';

    /**
     * @var CourseService|null
     */
    private ?CourseService $courseService;

    public function __construct()
    {
        $this->courseService = new CourseService();
    }

    /**
     * @param Course $course
     *
     * @return void
     */
    public function mount(Course $course): void
    {
        $this->name = $course->name;
        $this->course = $course;
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate(['name' => 'sometimes|string|max:255',]);
        $this->courseService->update($this->course, ['name' => $this->name,]);
        session()->flash('message', 'Course successfully updated.');
        $this->redirect(route('courses.list'));
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.update-course');
    }
}
