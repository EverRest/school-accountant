<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Enums\RoleEnum;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Students extends Component
{
    use WithPagination;

    /**
     * @var Collection
     */
    public Collection $users;

    /**
     * @var array
     */
    public array $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'phone_number', 'label' => 'Phone Number'],
    ];

    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->users = $this->getStudents();
    }

    /**
     * @param User $user
     *
     * @return void
     * @throws Throwable
     */
    public function delete(User $user): void
    {
        $this->userService->destroy($user);
        $this->users = $this->getStudents();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.students');
    }

    /**
     * @return Collection
     */
    protected function getStudents(): Collection
    {
        return $this->userService->getUsersByRoleCode(RoleEnum::Student->value);
    }
}
