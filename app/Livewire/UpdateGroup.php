<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;
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
use stdClass;

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
    public mixed $selectedTeachers = null;

    /**
     * @var mixed
     */
    public mixed $selectedStudents = null;

    /**
     * @var ?Group
     *
     */
    public ?Group $group = null;

    /**
     * @var GroupService|null
     */
    private ?GroupService $groupService;

    /**
     * @var TeacherService|null
     */
    private ?TeacherService $teacherService;

    /**
     * @var StudentService|null
     */
    private ?StudentService $studentService;

    public function __construct()
    {
        $this->groupService = new GroupService();
        $courses = (new CourseService())->all()->get();
        $this->courses = $courses;
        $this->teacherService = new TeacherService();
        $this->studentService = new StudentService();
        $this->teachers = $this->teacherService->all()
            ->chunkMap(fn($teacher) => $teacher->user);
        $this->students = $this->studentService->all()
            ->chunkMap(fn($student) => $student->user);
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
        $this->selectedCourse = $group->course->id;
        $selectedStudents = $group->students ?? Collection::make();
        $selectedTeachers = $group->teachers ?? Collection::make();
        $this->selectedStudents = $selectedStudents->map(fn(Student $s) => $s->user->id);
        $this->selectedTeachers = $selectedTeachers->map(fn(Teacher $t) => $t->user->id);
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate(['name' => 'sometimes|string|max:255',]);
        $group = $this->groupService
            ->update(
                $this->group,
                ['name' => $this->name, 'course_id' => $this->selectedCourse,]
            );
        $group->students()
            ->sync(
                $this->students
                    ->filter(
                        fn($student) => in_array($student->id, $this->selectedStudents->toArray())
                    )
                    ->map(
                        fn($student) => $student->student->id
                    )
            );
        $group->teachers()
            ->sync(
                $this->teachers
                    ->filter(
                        fn($teacher) => in_array($teacher->id, $this->selectedTeachers->toArray())
                    )
                    ->map(
                        fn($teacher) => $teacher->teacher->id
                    )
            );

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
