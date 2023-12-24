<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Models\Group;
use App\Services\CourseService;
use App\Services\GroupService;
use App\Services\StudentService;
use App\Services\TeacherService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class UpdateGroup extends Component
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
    public mixed $selectedCourse = '';

    /**
     * @var mixed
     */
    public mixed $teachers;

    /**
     * @var mixed
     */
    public mixed $students;

    /**
     * @var mixed
     */
    public mixed $selectedTeachers;

    /**
     * @var mixed
     */
    public mixed $selectedStudents;

    /**
     * @var Group
     *
     */
    private Group $group;

    /**
     * @var GroupService|null
     */
    private ?GroupService $groupService;

    public function __construct()
    {
        $this->groupService = new GroupService();
        $courses = (new CourseService())->all()->get();
        $this->courses = $courses;
        $this->students = (new StudentService())->all()->get();
        $this->teachers = (new TeacherService())->all()->get();
    }

    /**
     * @param Group $group
     *
     * @return void
     */
    #[NoReturn] public function mount(Group $group): void
    {
        $this->group = $group;
        $this->name = $group->name;
        $students = $group->students??Collection::make();
        $teachers = $group->teachers??Collection::make();
        $this->selectedStudents = $students->map(fn($s) => $s->user);
        $this->selectedTeachers = $teachers->map(fn($s) => $s->user);
        $this->selectedCourse = $group->course;
//        dd($this->selectedStudents, $this->selectedTeachers);
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate(['name' => 'sometimes|string|max:255',]);
        $this->groupService->update($this->group, ['name' => $this->name,'course_id' => $this->selectedCourse]);
        session()->flash('message', 'Group successfully updated.');
        $this->redirect(route('groups.list'));
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.update-group');
    }
}
