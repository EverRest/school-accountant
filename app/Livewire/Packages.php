<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Services\PackageService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Packages extends Component
{
    use WithPagination;

    /**
     * @var PackageService
     */
    public PackageService $packageService;

    /**
     * @var mixed
     */
    public mixed $packages = null;

    /**
     * @var string
     */
    public string $search = '';

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

    public function __construct()
    {
        $this->packageService = new PackageService();
    }

    /**
     * @return void
     */
    public function searchQ(): void
    {
        $q = $this->packageService->query();
        if ($this->search) {
            $this->packages = $q->where('name', 'like', "%$this->search%")
                ->get();
        } else {
            $this->packages = $q->get();
        }
    }

    /**
     * @param Package $package
     *
     * @return void
     * @throws Throwable
     */
    public function delete(Package $package): void
    {
        $this->packageService->destroy($package);
        $this->packages = $this->getPackages();
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->packages = $this->getPackages();
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.packages');
    }

    /**
     * @return array|Collection
     */
    private function getPackages(): array|Collection
    {
        return $this->packageService->all()->get();
    }
}
