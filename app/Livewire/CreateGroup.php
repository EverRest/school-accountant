<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Models\GroupStudent;
use App\Models\GroupTeacher;
use App\Services\CourseService;
use App\Services\GroupService;
use App\Services\StudentService;
use App\Services\TeacherService;
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
     * @var int
     */
    public int $creatorId;

    /**
     * @var int
     */
    public int $courseId;

    /**
     * @var mixed
     */
    public mixed $courses;

    /**
     * @var mixed
     */
    public mixed $selectedCourse;

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
    public mixed $selectedTeacher = '';

    /**
     * @var mixed
     */
    public mixed $selectedStudents;

    /**
     * @var string[]
     */
    public array $rules = [
        'name' => 'required|unique:courses,name|min:3|max:255',
        'creatorId' => 'required',
        'courseId' => 'required',
    ];

    /**
     * @var GroupService
     */
    private GroupService $groupService;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->courses = (new CourseService())->all()->get();
        $this->teachers = (new TeacherService())->all()->chunkMap(fn($teacher) => $teacher->user) ?? Collection::make();
        $this->students = (new StudentService())->all()->chunkMap(fn($student) => $student->user) ?? Collection::make();
        $this->groupService = new GroupService();
        $this->selectedStudents = Collection::make();
        $this->selectedCourse = null;
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->creatorId = intval(Auth::id());
        $this->courseId = intval($this->selectedCourse);
        $this->validate();
        /**
         * @var \App\Models\Group $group
         */
        $group = $this->groupService->store([
            'name' => $this->name,
            'creator_id' => $this->creatorId,
            'course_id' => $this->courseId,
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
        if ($this->selectedTeacher) {
            $group->teachers()
                ->sync(
                    [$this->teachers
                        ->first(fn($teacher) => $teacher->id === $this->selectedTeacher)
                        ->teacher->id,
                    ]);
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
