<?php
declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginForm extends Component
{
    private const VALIDATION_RULES = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    /**
     * @var string
     */
    public string $email = '';

    /**
     * @var string
     */
    public string $password = '';

    /**
     * @return void|null
     */
    public function submit()
    {
        $this->validate(self::VALIDATION_RULES);
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->redirect('/', navigate: true);
        } else {
            session()->flash('error', 'Invalid credentials');
        }
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        $this->email = '';
        $this->password = '';
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.login-form');
    }
}
