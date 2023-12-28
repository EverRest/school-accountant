<?php
declare(strict_types=1);

namespace App\Livewire\Users;

use App\Models\User;
use App\Services\UserService;
use App\Traits\Models\SaveAvatarTrait;
use Illuminate\Support\Facades\Hash;
use Throwable;

class CreateStudent extends CreateUser
{
    use SaveAvatarTrait;

    /**
     * @var string
     */
    public string $role = 'student';

    /**
     * @var string
     */
    protected string $backRoute = 'students.list';

    /**
     * @var string
     */
    public string $parent = '';

    /**
     * @var mixed
     */
    public mixed $avatar = null;

    /**
     * @var string[]
     */
    protected array $rules = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'phone_number' => 'required|string|max:255',
        'avatar' => 'required|file',
        'parent' => 'required|string|max:255',
    ];

    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @var string
     */
    protected string $view = 'livewire.create-student';

    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
    }

    /**
     * @return void
     * @throws Throwable
     */
    public function submit(): void
    {
        $this->validate();
        /**
         * @var User $user
         */
        $user = $this->userService
            ->store([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'phone_number' => $this->phone_number,
            ]);
        $this->saveAvatar($user, $this->avatar);
        $user->assignRole($this->role);
        $user->student()->create([
            'user_id' => $user->id,
            'parent' => $this->parent,
        ]);
        $this->reset();
        session()->flash('message', 'Student successfully created.');
        $this->redirect(route($this->backRoute));
    }
}
