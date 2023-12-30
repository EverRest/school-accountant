<?php
declare(strict_types=1);
namespace App\Livewire\Users;

use App\Models\User;
use App\Services\PackageService;
use App\Services\UserService;
use App\Traits\Models\SaveAvatarTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateStudent extends Component
{
    use SaveAvatarTrait;

    /**
     * @var mixed
     */
    public mixed $packages;

    /**
     * @var mixed
     */
    public mixed $package_id;

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
     * @var string
     */
    public string $parent = '';

    /**
     * @var mixed
     */
    public mixed $avatar = null;

    /**
     * @var UserService|null
     */
    private ?UserService $userService;

    /**
     * @var PackageService|null
     */
    private ?PackageService $packageService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->packageService = new PackageService();
        $this->packages = $this->packageService->all()->get();
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
        $this->parent = $user->student?->parent ?? '';
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
            'parent' => 'sometimes|string|min:2|max:255',
            'package_id' => 'sometimes|exists:packages,id',
                                                                                                                            ]);
        /**
         * @var User $user
         */
        $user = $this->userService->update($this->user, [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'parent' => $this->parent,
        ]);
        $student = $user->student;
        if ($this->parent) {
            $student->update([
                'parent' => $this->parent,
            ]);
        }
        if ($this->package_id) {
            $package = $this->packageService->findOrFail($this->package_id);
            $student->studentPackages()->create([
                'price' => $package->price,
                'package_id' => $this->package_id,
                'student_id' => $student->id,
            ]);
        }
        session()->flash('message', 'Student successfully updated.');
        $this->redirect(route('students.list'));
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.update-student');
    }
}
