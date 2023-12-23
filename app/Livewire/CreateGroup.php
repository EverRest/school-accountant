<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Models\GroupStudent;
use App\Models\GroupTeacher;
use App\Services\CourseService;
use App\Services\GroupService;
use App\Services\StudentService;
use App\Services\TeacherService;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
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
     * @var string[]
     */
    public array $rules = [
        'name' => 'required|unique:courses,name',
    ];

    /**
     * @var GroupService
     */
    private GroupService $groupService;

    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct()
    {
        $this->courses = (new CourseService())->all()->get();
        $this->teachers = (new TeacherService())->all()->chunkMap(fn($teacher) => $teacher->user);
        $this->students = (new StudentService())->all()->chunkMap(fn($student) => $student->user);
        $this->groupService = new GroupService();
        $this->selectedStudents = Collection::make();
        $this->selectedTeachers = Collection::make();
        $this->userService = new UserService();
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate();
        /**
         * @var Group $group
         */
        $group = $this->groupService->store([
            'name' => $this->name,
            'creator_id' => Auth::id(),
            'course_id' => $this->selectedCourse,
        ]);
        $this->selectedStudents->each(
            function ($id) use ($group) {
                $user = $this->userService->findOrFail($id);
                GroupStudent::create(['group_id' => $group->id, 'student_id' => $user->student->id]);
            }
        );
        $this->selectedTeachers->each(
            function ($id) use ($group) {
                $user = $this->userService->findOrFail($id);
                GroupTeacher::create(['group_id' => $group->id, 'teacher_id' => $user->teacher->id]);
            }
        );
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
