<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Enums\RoleEnum;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Administrators extends Component
{
    /**
     * @param UserService $userService
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(UserService $userService): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = $userService->getUsersByRoleCodePaginated(RoleEnum::Administrator->value);

        return view('livewire.administrators', compact('users'));
    }
}
