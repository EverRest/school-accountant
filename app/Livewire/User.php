<?php
declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\User as Model;

class User extends Component
{
    /**
     * @var Model
     */
    public Model $user;

    /**
     * @var string
     */
    public string $role = '';

    /**
     * @var string
     */
    public string $backUrl = '';

    /**
     * @param Model $user
     *
     * @return void
     */
    public function mount(Model $user): void
    {
        $this->user = $user;
        $this->role = $user->roles()->first()->name;
        $this->backUrl = route(Str::plural($this->role) . '.list');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function render(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('livewire.user');
    }
}
