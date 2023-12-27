<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Services\CourseService;
use App\Services\GroupService;
use App\Services\StudentService;
use App\Services\TeacherService;
use App\Traits\Models\SaveAvatarTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateGroup extends Component
{
    use SaveAvatarTrait;

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
     * @var int
     */
    public int $selectedTeacherId;

    /**
     * @var mixed
     */
    public mixed $teacherId = null;

    /**
     * @var mixed
     */
    public mixed $selectedStudents;

    /**
     * @var mixed
     */
    public mixed $avatar = null;

    /**
     * @var string[]
     */
    public array $rules = [
        'name' => 'required|unique:courses,name|min:3|max:255',
        'creatorId' => 'required|exists:users,id',
        'courseId' => 'required|exists:courses,id',
        'selectedTeacherId' => 'required|exists:teachers,user_id',
        'avatar' => 'required|image|max:10240',
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
        $this->saveAvatar($group, $this->avatar);
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
        $group->teachers()
            ->sync(
                [$this->teachers
                    ->first(fn($teacher) => $teacher->id === $this->selectedTeacherId)
                    ->teacher->id,
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
