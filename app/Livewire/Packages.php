<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Services\PackageService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class Packages extends Component
{
    use WithPagination;

    /**
     * @var array
     */
    public array $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'creator', 'label' => 'Creator'],
        ['key' => 'count_lesson', 'label' => 'Lessons '],
        ['key' => 'price', 'label' => 'Price'],
    ];

    /**
     * @var mixed
     */
    public mixed $packages;

    /**
     * @param PackageService $packageService
     *
     * @return void
     */
    public function mount(PackageService $packageService): void
    {
        $this->packages = $packageService->all()->get();
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.packages');
    }
}
