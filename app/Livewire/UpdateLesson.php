<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Models\Lesson;
use App\Services\GroupService;
use App\Services\LessonService;
use Livewire\Component;

class UpdateLesson extends Component
{
    /**
     * @var ?Lesson
     */
    public ?Lesson $lesson = null;

    /**
     * @var mixed
     */
    public mixed $groups;

    /**
     * @var ?string
     */
    public ?string $date = null;

    /**
     * @var LessonService|null
     */
    private ?LessonService $lessonService;

    public function __construct()
    {
        $this->lessonService = new LessonService();
        $this->groups = (new GroupService())->all()->get();
    }

    /**
     * @param Lesson $lesson
     *
     * @return void
     */
    public function mount(Lesson $lesson): void
    {
        $this->date = $lesson->date;
        $this->lesson = $lesson;
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate(['date' => 'sometimes|date',]);
        $this->lessonService->update($this->lesson, ['date' => $this->date,]);

        session()->flash('message', 'Lesson successfully updated.');
    }

    public function render()
    {
        return view('livewire.update-lesson');
    }
}
