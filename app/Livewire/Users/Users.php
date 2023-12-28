<?php
declare(strict_types=1);

namespace App\Livewire\Users;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
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
     * @var string
     */
    public string $search = '';

    /**
     * @var string
     */
    public string $createUrl = '';

    /**
     * @var string
     */
    protected string $role = '';

    /**
     * @var string
     */
    protected string $view = '';

    /**
     * @var array
     */
    public array $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'avatar', 'label' => 'Photo'],
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
        $this->users = $this->getUsers();
    }

    /**
     * @return void
     */
    public function searchQ(): void
    {
        $q = $this->userService->query();
        $this->users = $this->search ? $q->where('name', 'like', "%$this->search%")
            ->orWhere('email', 'like', "%$this->search%")
            ->whereHas('roles', fn($q) => $q->where('name', $this->role))
            ->get() : $q->get();
        $this->search = '';
    }

    /**
     * @param \App\Livewire\Users\User $user
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
     * @param int $user_id
     *
     * @return void
     */
    public function edit(int $user_id): void
    {
        $this->redirect(route(Str::plural($this->role) . ".update", ['user' => $user_id]));
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
