<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Services\LessonService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    /**
     * @var mixed
     */
    public mixed $lessons;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->lessons = (new LessonService())->query()
            ->whereBetween('date', [Carbon::today(), Carbon::tomorrow()])
            ->get();
    }

    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.dashboard');
    }
}
