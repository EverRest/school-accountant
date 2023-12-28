<?php
declare(strict_types=1);
namespace App\Livewire\Packages;

use App\Models\Package as Model;
use App\Services\PackageService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Packages extends Component
{
    use WithPagination;

    /**
     * @var mixed
     */
    public mixed $packages;

    /**
     * @var string
     */
    public string $search = '';

    /**
     * @var PackageService
     */
    private PackageService $packageService;

    /**
     * @var array
     */
    public array $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'creator', 'label' => 'Creator'],
        ['key' => 'price', 'label' => 'Price'],
        ['key' => 'count_lesson', 'label' => 'Lessons'],
    ];

    public function __construct()
    {
        $this->packageService = new PackageService();
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->packages = $this->getPackages();
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
     * @param Model $package
     *
     * @return void
     * @throws Throwable
     */
    public function delete(Model $package): void
    {
        $this->packageService->destroy($package);
        $this->packages = $this->getPackages();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.packages');
    }

    /**
     * @return Collection
     */
    protected function getPackages(): Collection
    {
        return $this->packageService->all()->get();
    }
}
