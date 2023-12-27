<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Throwable;

class CreateTeacher extends CreateUser
{
    /**
     * @var string
     */
    public string $role = 'teacher';

    /**
     * @var float
     */
    public float $individual_lesson_salary = 0.00;

    /**
     * @var float
     */
    public float $group_lesson_salary = 0.00;

    /**
     * @var mixed
     */
    public mixed $avatar = null;

    /**
     * @var string
     */
    public string $view = 'livewire.create-teacher';

    /**
     * @var string[]
     */
    protected array $rules = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'phone_number' => 'required|string|max:255',
        'individual_lesson_salary' => 'required|numeric|min:1',
        'group_lesson_salary' => 'required|numeric|min:1',
        'avatar' => 'required|file',
    ];

    /**
     * @var string
     */
    protected string $backRoute = 'teachers.list';

    /**
     * @var UserService
     */
    private UserService $userService;

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
        $filePath = $this->saveAvatar();
        /**
         * @var User $user
         */
        $user = $this->userService
            ->store([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'phone_number' => $this->phone_number,
                'avatar' => $filePath,
            ]);
        $user->assignRole($this->role);
        $user->teacher()->create([
            'individual_lesson_salary' => $this->individual_lesson_salary,
            'group_lesson_salary' => $this->group_lesson_salary
        ]);
        $filename = Carbon::now()->timestamp . '_' . $this->avatar->getClientOriginalName();
        $filePath = $this->avatar->storeAs('uploads', $filename, 'local');
        $this->userService->updateOrFail($user, ['avatar' => $filePath]);
        $this->reset();
        session()->flash('message', 'Teacher successfully created.');
        $this->redirect(route($this->backRoute));
    }
}
