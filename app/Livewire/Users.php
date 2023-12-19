<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
     * @var string
     */
    public string $search = '';

    /**
     * @var string
     */
    public string $createUrl = '';

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
     * @return void
     */
    public function searchQ(): void
    {
        $q = $this->userService->query();
        if ($this->search) {
            $this->users = $q->where('name', 'like', "%$this->search%")
                ->orWhere('email', 'like', "%$this->search%")
                ->whereHas('roles', fn($q) => $q->where('name', $this->role))
                ->get();
        } else {
            $this->users = $q->get();
        }
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
     * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
     */
    public function create(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        return redirect($this->createUrl);
    }

    /**
     * @param User $user
     *
     * @return void
     */
    public function edit(User $user): void
    {
        $this->redirectRoute('users.update', ['user' => $user]);
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
