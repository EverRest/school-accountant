<?php
declare(strict_types=1);
namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use App\Models\Package as Model;

class Package extends Component
{
    /**
     * @var Model
     */
    public Model $package;

    /**
     * @param Model $package
     *
     * @return void
     */
    public function mount(Model $package): void
    {
        $this->package = $package;
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.package');
    }
}
