<?php
declare(strict_types=1);
namespace App\Livewire\Courses;

use App\Models\Course as Model;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Course extends Component
{
    /**
     * @var Model
     */
    public Model $course;

    /**
     * @param Model $course
     *
     * @return void
     */
    public function mount(Model $course): void
    {
        $this->course = $course;
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.course');
    }
}
