<?php
declare(strict_types=1);
namespace App\Livewire\Lessons;

use App\Models\Lesson as Model;
use App\Services\LessonService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Lessons extends Component
{
    use WithPagination;

    /**
     * @var mixed
     */
    public mixed $lessons;

    /**
     * @var mixed
     */
    public mixed $groups;

    /**
     * @var string
     */
    public string $search = '';

    /**
     * @var array
     */
    public array $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'avatar', 'label' => 'Photo'],
        ['key' => 'name', 'label' => 'Theme'],
        ['key' => 'date', 'label' => 'Date'],
        ['key' => 'course', 'label' => 'Course'],
        ['key' => 'group', 'label' => 'Group'],
        ['key' => 'creator', 'label' => 'Creator'],
    ];

    /**
     * @var LessonService
     */
    private LessonService $lessonService;

    public function __construct()
    {
        $this->lessonService = new LessonService();
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->lessons = $this->getLessons();
    }

    /**
     * @return void
     */
    public function searchQ(): void
    {
        $q = $this->lessonService->query();
        if ($this->search) {
            $this->groups = $q->where('name', 'like', "%$this->search%")
                ->get();
        } else {
            $this->groups = $q->get();
        }
    }

    /**
     * @param Model $lesson
     *
     * @return void
     * @throws Throwable
     */
    public function delete(Model $lesson): void
    {
        $this->lessonService->destroy($lesson);
        $this->lessons = $this->getLessons();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.lessons');
    }

    /**
     * @return Collection
     */
    protected function getLessons(): Collection
    {
        return $this->lessonService->all()->get();
    }
}
