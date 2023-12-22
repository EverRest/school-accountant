<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Models\Course;
use App\Services\CourseService;
use App\Services\GroupService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateGroup extends Component
{
    /**
     * @var string
     */
    public string $name = '';

    /**
     * @var mixed
     */
    public mixed $courses;

    /**
     * @var mixed
     */
    public mixed  $selectedCourse;

    /**
     * @var string[]
     */
    public array $rules = [
        'name' => 'required|unique:courses,name',
    ];

    /**
     * @var GroupService
     */
    private GroupService $groupService;

    public function __construct()
    {
        $this->courses = (new CourseService())->all()->get();
        $this->groupService = new GroupService();
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate();
        $this->groupService->store([
            'name' => $this->name,
            'creator_id' => Auth::id(),
            'course_id' => $this->selectedCourse,
        ]);
        $this->reset();
        session()->flash('message', 'Group successfully created.');
        $this->redirect(route('groups.list'));
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-group');
    }
}
