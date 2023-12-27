<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Services\UserService;
use App\Traits\Models\SaveAvatarTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\User;

class UpdateTeacher extends Component
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
     * @var UserService|null
     */
    private ?UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * @return void
     */
    public function updatedAvatar(): void
    {
        $this->saveAvatar($this->user, $this->avatar);
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
        $this->group_lesson_salary = (float)$user->teacher?->group_lesson_salary;
        $this->individual_lesson_salary = (float)$user->teacher?->individual_lesson_salary;
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
            'group_lesson_salary' => 'sometimes|numeric|min:1',
            'individual_lesson_salary' => 'sometimes|numeric|min:1',

        ]);
        /**
         * @var User $user
         */
        $user = $this->userService->update($this->user, [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
        ]);
        $teacherAttributes = [];
        if ($this->individual_lesson_salary) {
            Arr::set($teacherAttributes, 'individual_lesson_salary', $this->individual_lesson_salary);
        }
        if ($this->group_lesson_salary) {
            Arr::set($teacherAttributes, 'group_lesson_salary', $this->group_lesson_salary);
        }
        if (!empty($teacherAttributes)) {
            $user->teacher()->update($teacherAttributes);
        }

        session()->flash('message', 'Teacher successfully updated.');
        $this->redirect(route('teachers.list'));
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.update-teacher');
    }
}
