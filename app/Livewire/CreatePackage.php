<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Services\LessonService;
use App\Services\PackageService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreatePackage extends Component
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var int
     */
    public int $count_lesson = 0;

    /**
     * @var float
     */
    public float $price = 0.00;

    /**
     * @var string[]
     */
    protected array $rules = [
        'name' => 'required|string|min:3|max:255',
        'count_lesson' => 'required|numeric|min:1',
        'price' => 'required|numeric',
    ];

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-package');
    }

    /**
     * @param PackageService $packageService
     *
     * @return void
     */
    public function submit(PackageService $packageService): void
    {
        $this->validate();
        $packageService->store([
            'creator_id' => Auth::id(),
            'name' => $this->name,
            'count_lesson' => $this->count_lesson,
            'price' => $this->price,
        ]);
        $this->reset();
        session()->flash('message', 'Package successfully created.');
        $this->redirect(route('packages.list'));
    }
}
