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

    public function __construct()
    {
        $this->courses = (new CourseService())->all()->get()??Collection::make();
        $this->teachers = (new TeacherService())->all()->chunkMap(fn($teacher) => $teacher->user);
        $this->students = (new StudentService())->all()->chunkMap(fn($student) => $student->user);
        $this->groupService = new GroupService();
        $this->selectedStudents = Collection::make();
        $this->selectedTeachers = Collection::make();
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate();
        /**
         * @var \App\Models\Group $group
         */
        $group = $this->groupService->store([
            'name' => $this->name,
            'creator_id' => Auth::id(),
            'course_id' => (int)$this->selectedCourse,
        ]);
        if ($this->selectedStudents->isNotEmpty()) {
            $selectedIdArray = $this->selectedStudents->toArray();
            $group->students()
                ->sync(
                    $this->students
                        ->filter(
                            fn($student) => in_array($student->id, $selectedIdArray)
                        )
                        ->map(
                            fn($student) => $student->student->id
                        )
                );
        }
        if ($this->selectedTeachers->isNotEmpty()) {
            $selectedIdArray = $this->selectedTeachers->toArray();
            $group->teachers()
                ->sync(
                    $this->teachers
                        ->filter(
                            fn($teacher) => in_array($teacher->id, $selectedIdArray)
                        )
                        ->map(
                            fn($teacher) => $teacher->teacher->id
                        )
                );
        }
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
