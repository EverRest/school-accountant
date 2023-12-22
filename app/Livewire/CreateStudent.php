<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class CreateStudent extends CreateUser
{
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
     * @var string[]
     */
    protected array $rules = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'phone_number' => 'required|string|max:255',
        'parent' => 'required|string|max:255'
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
            'phone_number' => $this->phone_number
        ]);
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
