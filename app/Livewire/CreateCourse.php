<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Services\CourseService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateCourse extends Component
{
    /**
     * @var string
     */
    public string $name = '';

    /**
     * @var string[]
     */
    public array $rules = [
        'name' => 'required|unique:courses,name',
    ];

    /**
     * @var CourseService
     */
    private CourseService $courseService;

    public function __construct()
    {
        $this->courseService = new CourseService();
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate();
        $this->courseService->store([
            'name' => $this->name,
            'creator_id' => Auth::id(),
        ]);
        $this->reset();
        session()->flash('message', 'Course successfully created.');
        $this->redirect(route('courses.list'));
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-course');
    }
}
