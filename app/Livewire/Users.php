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

class Users extends Component
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
     * @var string
     */
    protected string $role = '';

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
        $this->users = $this->getUsers();
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
        $this->users = $this->getUsers();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.users');
    }

    /**
     * @return Collection
     */
    protected function getUsers(): Collection
    {
        return $this->userService->getUsersByRoleCode($this->role);
    }
}
