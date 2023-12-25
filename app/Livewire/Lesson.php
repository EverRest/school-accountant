<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Models\Lesson as Model;
use Livewire\Component;

class Lesson extends Component
{
    /**
     * @var Model
     */
    public Model $lesson;

    /**
     * @param Model $lesson
     *
     * @return void
     */
    public function mount(Model $lesson): void
    {
        $this->lesson = $lesson;
    }

    public function render()
    {
        return view('livewire.lesson');
    }
}
