<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Models\Lesson;
use App\Services\GroupService;
use App\Services\LessonService;
use App\Services\UserService;
use App\Traits\Models\SaveAvatarTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class UpdateLesson extends Component
{
    use SaveAvatarTrait;

    /**
     * @var string
     */
    public string $name = '';

    /**
     * @var ?Lesson
     */
    public ?Lesson $lesson = null;

    /**
     * @var mixed
     */
    public mixed $groups;

    /**
     * @var mixed
     */
    public mixed $users;

    /**
     * @var ?string
     */
    public ?string $date = null;

    /**
     * @var mixed
     */
    public mixed $avatar = null;

    /**
     * @var LessonService|null
     */
    private ?LessonService $lessonService;

    public function __construct()
    {
        $this->lessonService = new LessonService();
        $this->groups = (new GroupService())->all()->get();
        $this->users = (new UserService())->getUsersByRoleCode('teacher');
    }

    /**
     * @return void
     */
    public function updatedAvatar(): void
    {
        $this->saveAvatar($this->lesson, $this->avatar);
    }

    /**
     * @param Lesson $lesson
     *
     * @return void
     */
    public function mount(Lesson $lesson): void
    {
        $this->name = $lesson->name ?? '';
        $this->date = $lesson->date;
        $this->lesson = $lesson;
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate(['date' => 'sometimes|date','name' => '']);
        $this->lessonService->update($this->lesson, ['date' => $this->date,'name' => $this->name]);
        session()->flash('message', 'Lesson successfully updated.');
        $this->redirect(route('lessons.list'));
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.update-lesson');
    }
}
