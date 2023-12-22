<?php
declare(strict_types=1);
namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Hash;

class CreateTeacher extends CreateUser
{
    /**
     * @var string
     */
    public string $role = 'teacher';

    /**
     * @var string[]
     */
    protected array $rules = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'phone_number' => 'required|string|max:255'
    ];

    /**
     * @var string
     */
    protected string $backRoute = 'teachers.list';

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
        $this->reset();
        session()->flash('message', 'User successfully created.');
        $this->redirect(route($this->backRoute));
    }

    /**
     * @return View|Factory|Application|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Factory|Application|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-teacher');
    }
}
