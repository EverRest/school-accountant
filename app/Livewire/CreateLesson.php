<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Services\GroupService;
use App\Services\LessonService;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateLesson extends Component
{
    private const TEACHER_ROLE = 'teacher';

    /**
     * @var mixed
     */
    public mixed $group_id;

    /**
     * @var mixed
     */
    public mixed $teacher_id;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var mixed
     */
    public mixed $date;

    /**
     * @var mixed
     */
    public mixed $groups;

    /**
     * @var mixed
     */
    public mixed $teachers;

    /**
     * @var string[]
     */
    protected array $rules = [
        'name' => 'required|string|min:3|max:255',
        'teacher_id' => 'required|exists:users,id',
        'group_id' => 'required|exists:groups,id',
        'date' => 'required|date',
    ];

    /**
     * @var LessonService
     */
    private LessonService $lessonService;

    public function __construct()
    {
        $this->lessonService = new LessonService();
        $this->teachers = (new UserService())->getUsersByRoleCode(self::TEACHER_ROLE);
        $this->groups = (new GroupService())->all()->get();
        $this->date = Carbon::now();
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-lesson');
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate();
        $this->lessonService
            ->store([
                'name' => $this->name,
                'creator_id' => Auth::id(),
                'group_id' => $this->group_id,
                'teacher_id' => $this->teacher_id,
                'date' => $this->date
            ]);
        $this->reset();
        session()->flash('message', 'Lesson successfully created.');
        $this->redirect(route('lessons.list'));
    }
}
