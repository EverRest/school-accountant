<?php
declare(strict_types=1);
namespace App\Livewire\Users;

use App\Models\User;
use App\Services\UserService;
use App\Traits\Models\SaveAvatarTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

abstract class CreateUser extends Component
{
    use WithFileUploads;
    use SaveAvatarTrait;

    /**
     * @var string
     */
    public string $role = '';

    /**
     * @var string
     */
    public string $name = '';

    /**
     * @var string
     */
    public string $email = '';

    /**
     * @var string
     */
    public string $password = '';

    /**
     * @var string
     */
    public string $phone_number = '';

    /**
     * @var mixed
     */
    public mixed $avatar = null;

    /**
     * @var string
     */
    protected string $backRoute = '';

    /**
     * @var string
     */
    protected string $view = '';

    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * @var string[]
     */
    protected array $rules = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'phone_number' => 'required|string|max:255',
        'avatar' => 'required|image|max:10240'
    ];

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate();
        /**
         * @var User $user
         */
        $user = $this->userService->store([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone_number' => $this->phone_number,
        ]);
        $this->saveAvatar($user, $this->avatar);
        $user->assignRole($this->role);
        $this->reset();
        session()->flash('message', 'User successfully created.');
        $this->redirect(route($this->backRoute));
    }

    /**
     * @return View|Factory|Application|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Factory|Application|\Illuminate\Contracts\Foundation\Application
    {
        return view($this->view??'livewire.create-user');
    }
}
