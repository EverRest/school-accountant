<?php
declare(strict_types=1);
namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use App\Models\Group as Model;

class Group extends Component
{
    public Model $group;

    /**
     * @param Model $group
     *
     * @return void
     */
    public function mount(Model $group): void
    {
        $this->group = $group;
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.group');
    }
}
