<?php
declare(strict_types=1);

namespace App\Livewire\Users;

use App\Models\User;
use App\Services\UserService;
use App\Traits\Models\SaveAvatarTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateUser extends Component
{
    use SaveAvatarTrait;

    /**
     * @var ?User
     */
    public ?User $user = null;

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
     * @var UserService|null
     */
    private ?UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * @param User $user
     *
     * @return void
     */
    public function mount(User $user): void
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number;
        $this->avatar = $user->photo;
    }

    /**
     * @return void
     */
    public function updatedAvatar(): void
    {
        $this->saveAvatar($this->user, $this->avatar);
    }

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate([
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'email', Rule::unique('users')->ignore($this->user->id),],
            'password' => 'sometimes|min:6',
            'phone_number' => 'sometimes|string|max:255',
            'avatar' => 'sometimes|image|max:10240'
        ]);
        $this->userService->update($this->user, [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
        ]);
        session()->flash('message', 'User successfully updated.');
        $this->redirect(route('administrators.list'));
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.update-user');
    }
}
