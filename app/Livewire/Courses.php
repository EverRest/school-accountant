<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Courses extends Component
{
    use WithPagination;

    /**
     * @var mixed
     */
    public mixed $courses;

    /**
     * @var string
     */
    public string $search = '';

    /**
     * @var array
     */
    public array $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'creator', 'label' => 'Creator'],
    ];

    /**
     * @var CourseService
     */
    private CourseService $courseService;

    public function __construct()
    {
        $this->courseService = new CourseService();
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->courses = $this->getCourses();
    }

    /**
     * @return void
     */
    public function searchQ(): void
    {
        $q = $this->courseService->query();
        if ($this->search) {
            $this->courses = $q->where('name', 'like', "%$this->search%")
                ->get();
        } else {
            $this->courses = $q->get();
        }
    }

    /**
     * @param Course $course
     *
     * @return void
     * @throws Throwable
     */
    public function delete(Course $course): void
    {
        $this->courseService->destroy($course);
        $this->courses = $this->getCourses();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
     */
    public function create(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        return redirect('courses/create');
    }

    /**
     * @param Course $course
     *
     * @return void
     */
    public function edit(Course $course): void
    {
        $this->redirectRoute('courses.update', ['course' => $course]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.courses');
    }

    /**
     * @return Collection
     */
    protected function getCourses(): Collection
    {
        return $this->courseService->all()->get();
    }
}
