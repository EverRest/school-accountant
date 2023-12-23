<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Models\Package as Model;
use App\Services\PackageService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class UpdatePackage extends Component
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
     * @param PackageService $packageService
     * @return void
     */
    public function submit(PackageService $packageService): void
    {
        $this->validate(['date' => 'sometimes|date',]);
        $packageService->update($this->package, ['name' => $this->date,]);
        session()->flash('message', 'Package successfully updated.');
        $this->redirect(route('packages.list'));
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.update-package');
    }
}
